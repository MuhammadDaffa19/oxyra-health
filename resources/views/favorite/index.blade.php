<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">⭐ Kota Favorit Anda</h2>
    </x-slot>
    <div class="max-w-3xl mx-auto px-6 py-10 bg-white shadow-xl rounded-2xl text-black font-bold">
        <div class="max-w-4xl mx-auto">
            @if (session('status'))
                <div class="mb-4 p-3 rounded bg-green-600 text-white shadow">
                    {{ session('status') }}
                </div>
            @endif

            @forelse ($favorites as $city)
                <div class="p-4 mb-3 bg-emerald-600 rounded-lg shadow flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <div>
                        <h3 class="font-semibold text-lg">
                            {{ $city->flag }} {{ $city->city_name }}, {{ $city->state }}, {{ $city->country }}
                        </h3>
                        <p class="text-sm text-gray-300">Lat: {{ $city->lat }}, Lng: {{ $city->lng }}</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2">
                        {{-- Tombol ke Peta --}}
                        <a href="{{ route('home', [
                            'lat' => $city->lat,
                            'lng' => $city->lng,
                            'city' => urlencode("{$city->city_name}, {$city->state}, {$city->country}")
                        ]) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded text-sm text-center">
                            📍 Lihat di Peta
                        </a>

                        {{-- Tombol Hapus --}}
                        <form method="POST" action="{{ route('favorite.destroy', $city) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-1.5 rounded text-sm text-white">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">Belum ada kota favorit yang disimpan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
