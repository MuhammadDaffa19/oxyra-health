<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AirQualityController extends Controller
{
    public function index()
    {
        // Ambil API Key dari .env
        $maptilerKey = env('MAPTILER_API_KEY');

        // Kirim ke view
        return view('airquality.index', compact('maptilerKey'));
    }

    public function searchCity(Request $request)
    {
        $city = $request->query('city');
        $geoKey = env('OPENCAGE_API_KEY');
        $aqiKey = env('AIR_QUALITY_API_KEY');

        // 1. Gunakan OpenCage Geocoding API untuk konversi kota → lat/lng
        $geoRes = Http::get("https://api.opencagedata.com/geocode/v1/json", [
            'q' => $city,
            'key' => $geoKey,
            'language' => 'id',
            'limit' => 1
        ]);

        if (!$geoRes->successful() || empty($geoRes['results'])) {
            return response()->json(['error' => 'Kota tidak ditemukan'], 404);
        }

        $lat = $geoRes['results'][0]['geometry']['lat'];
        $lng = $geoRes['results'][0]['geometry']['lng'];
        $namaKota = $geoRes['results'][0]['formatted'];

        // 2. Gunakan WAQI Feed Geo API untuk ambil AQI dari titik tersebut
        $aqiRes = Http::get("https://api.waqi.info/feed/geo:$lat;$lng/", [
            'token' => $aqiKey
        ]);

        if (!$aqiRes->successful() || $aqiRes['status'] !== 'ok') {
            return response()->json(['error' => 'Data kualitas udara tidak tersedia'], 500);
        }

        return response()->json([
            'city' => $namaKota,
            'lat' => $lat,
            'lng' => $lng,
            'aqi' => $aqiRes['data']['aqi'],
            'dominentpol' => $aqiRes['data']['dominentpol'],
        ]);
    }
}
