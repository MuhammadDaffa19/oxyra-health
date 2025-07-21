<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteCityController extends Controller
{
    // Menampilkan daftar kota favorit user
    public function index()
    {
        $favorites = FavoriteCity::where('user_id', Auth::id())->get();
        return view('favorite.index', compact('favorites'));
    }

    // Menyimpan kota ke favorit
    public function store(Request $request)
    {
        $request->validate([
            'city_name'     => 'required|string',
            'state'         => 'nullable|string',
            'country'       => 'required|string',
            'country_code'  => 'required|string|size:2',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
        ]);

        $userId = Auth::id();

        // ✅ Cek jika kota sudah ada di favorit user
        $exists = FavoriteCity::where('user_id', $userId)
            ->where('city_name', $request->city_name)
            ->where('state', $request->state)
            ->where('country', $request->country)
            ->where('country_code', $request->country_code)
            ->exists();

        // 🔁 Responsif terhadap permintaan via AJAX / axios
        if ($request->wantsJson()) {
            if ($exists) {
                return response()->json([
                    'message' => 'Kota sudah difavoritkan.'
                ], 409); // Conflict
            }

            $favorite = FavoriteCity::create([
                'user_id'      => $userId,
                'city_name'    => $request->city_name,
                'state'        => $request->state,
                'country'      => $request->country,
                'country_code' => $request->country_code,
                'flag'         => $this->flagFromCode($request->country_code),
                'lat'          => $request->lat,
                'lng'          => $request->lng,
            ]);

            return response()->json([
                'message' => 'Kota berhasil disimpan.',
                'data'    => $favorite
            ]);
        }

        // 🔁 Jika BUKAN dari axios, redirect biasa
        if ($exists) {
            return redirect()->back()->with('status', '⚠️ Kota sudah ada di daftar favorit.');
        }

        FavoriteCity::create([
            'user_id'      => $userId,
            'city_name'    => $request->city_name,
            'state'        => $request->state,
            'country'      => $request->country,
            'country_code' => $request->country_code,
            'flag'         => $this->flagFromCode($request->country_code),
            'lat'          => $request->lat,
            'lng'          => $request->lng,
        ]);

        return redirect()->back()->with('status', '⭐ Kota berhasil disimpan ke favorit!');
    }

    // Menghapus kota favorit
    public function destroy(FavoriteCity $favoriteCity)
    {
        if ($favoriteCity->user_id === Auth::id()) {
            $favoriteCity->delete();
            return redirect()->back()->with('status', '❌ Kota favorit berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus ini.');
    }

    // Konversi kode negara ke emoji bendera
    private function flagFromCode($code)
    {
        return collect(str_split(strtoupper($code)))
            ->map(fn($c) => mb_chr(ord($c) + 127397, 'UTF-8'))
            ->join('');
    }
}
