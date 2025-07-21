<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FavoriteCityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Fungsi bantu untuk konversi country code ke emoji bendera
function countryFlagEmoji($countryCode)
{
    return collect(str_split(strtoupper($countryCode)))
        ->map(fn($char) => mb_chr(ord($char) + 127397, 'UTF-8'))
        ->join('');
}

// 🏠 Halaman utama publik — Diperbaiki agar kirim $maptilerKey
Route::get('/', function () {
    $maptilerKey = env('MAPTILER_API_KEY');
    return view('airquality.index', compact('maptilerKey'));
})->name('home');

// 💡 Halaman Tips Kesehatan
Route::get('/tips-kesehatan', function () {
    return view('airquality.tips');
})->name('tips.kesehatan');

// 🔐 Dashboard (akses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 👤 Profil & Password
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/favorite-cities', [FavoriteCityController::class, 'index'])->name('favorite.index');
    Route::post('/favorite-cities', [FavoriteCityController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite-cities/{favoriteCity}', [FavoriteCityController::class, 'destroy'])->name('favorite.destroy');
});

Route::get('/edukasi-polusi', function () {
    return view('airquality.edukasi');
})->name('tips.edukasi');

Route::get('/lokasi-saya', function () {
    $weatherbitKey = env('WEATHERBIT_API_KEY');
    return view('airquality.lokasi', compact('weatherbitKey'));
})->name('lokasi.saya');

Route::get('/cek-risiko-ispa', function () {
    return view('airquality.ispa-check');
})->name('cek.ispa');

Route::get('/kalkulator-napas', function () {
    return view('napas.nafas');
})->name('napas.nafas');

// 🔍 API: Cari Kota (OpenCage & WAQI)
Route::get('/search-city', function (Request $request) {
    $city = $request->query('city');
    $geoKey = env('OPENCAGE_API_KEY');
    $airKey = env('AIR_QUALITY_API_KEY');

    if (!$city || strlen($city) < 2) {
        return response()->json(['error' => 'Nama kota tidak valid'], 400);
    }

    $geoResponse = Http::get("https://api.opencagedata.com/geocode/v1/json", [
        'q' => $city,
        'key' => $geoKey,
        'language' => 'id',
        'limit' => 1,
    ]);

    if ($geoResponse->failed() || empty($geoResponse['results'])) {
        return response()->json(['error' => 'Kota tidak ditemukan'], 404);
    }

    $geo = $geoResponse['results'][0];
    $lat = $geo['geometry']['lat'];
    $lng = $geo['geometry']['lng'];
    $components = $geo['components'];

    // Susun lokasi secara lengkap dan berurutan
    $parts = [
        $components['neighbourhood'] ?? null,
        $components['suburb'] ?? null,
        $components['village'] ?? null,
        $components['town'] ?? null,
        $components['city'] ?? null,
        $components['municipality'] ?? null,
        $components['state'] ?? null,
        $components['country'] ?? null,
    ];

    $filteredParts = array_filter(array_unique($parts));
    $fullLocation = implode(', ', $filteredParts);

    // Ambil data untuk keperluan favorit
    $cityName = $components['neighbourhood']
        ?? $components['suburb']
        ?? $components['village']
        ?? $components['town']
        ?? $components['city']
        ?? '-';

    $state = $components['state'] ?? '';
    $country = $components['country'] ?? '';
    $countryCode = strtoupper($components['country_code'] ?? 'ID');
    $flag = countryFlagEmoji($countryCode);

    $aqiResponse = Http::get("https://api.waqi.info/feed/geo:$lat;$lng/", [
        'token' => $airKey,
    ]);

    if ($aqiResponse->failed() || $aqiResponse['status'] !== 'ok') {
        return response()->json(['error' => 'Data kualitas udara tidak tersedia'], 500);
    }

    $data = $aqiResponse['data'];

    return response()->json([
        'city' => $fullLocation,
        'city_name' => $cityName,
        'state' => $state,
        'country' => $country,
        'country_code' => $countryCode,
        'flag' => $flag,
        'lat' => $lat,
        'lng' => $lng,
        'aqi' => $data['aqi'] ?? 0,
        'dominentpol' => $data['dominentpol'] ?? '-',
    ]);
});

// 🔑 Autentikasi Breeze (Login/Register)
require __DIR__.'/auth.php';
