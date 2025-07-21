<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Custom Loading Spinner -->
    <style>
        #global-loading {
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #38bdf8;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin-top: 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-white">

    <!-- ✅ GLOBAL LOADING SPINNER -->
    <div id="global-loading">
        <h1 class="text-2xl text-white font-bold">⏳ Tunggu sebentar...</h1>
        <div class="spinner"></div>
    </div>

    <!-- ✅ TOP BAR -->
    <div class="w-full bg-white text-black py-3 px-6 flex justify-between items-center shadow-md">
        <!-- 🟦 Beranda -->
        <a href="{{ route('home') }}" class="text-blue-600 text-lg font-bold hover:underline">
            KEMBALI KE PETA
        </a>

        <!-- 🟨 MENU RESPONSIF -->
        <div x-data="{ open: false }" class="relative">
            <!-- Tombol Hamburger di Mobile -->
            <button @click="open = !open" class="md:hidden text-3xl text-gray-800">
                ☰
            </button>

            <!-- Menu (Mobile + Desktop) -->
            <div :class="open ? 'block' : 'hidden'" class="absolute md:static top-full right-0 md:flex md:space-x-4 bg-white md:bg-transparent text-sm font-semibold rounded shadow-lg md:shadow-none p-4 md:p-0 mt-2 md:mt-0 z-50">
                <a href="{{ route('favorite.index') }}" class="block md:inline-block bg-emerald-600 hover:bg-emerald-700 px-3 py-1 rounded text-white">⭐ Kota Favorit</a>
                <a href="{{ route('tips.kesehatan') }}" class="block md:inline-block bg-yellow-600 hover:bg-yellow-700 px-3 py-1 rounded text-white">💡 Tips Kesehatan</a>
                <a href="{{ route('tips.edukasi') }}" class="block md:inline-block bg-pink-600 hover:bg-pink-700 px-3 py-1 rounded text-white">📘 Edukasi Polusi & ISPA</a>
                <a href="{{ route('lokasi.saya') }}" class="block md:inline-block bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">📍 Lokasi Saya</a>
                <a href="{{ route('cek.ispa') }}" class="block md:inline-block bg-indigo-600 hover:bg-indigo-700 px-3 py-1 rounded text-white">🩺 Cek Risiko ISPA</a>
                <a href="{{ route('napas.nafas') }}" class="block md:inline-block bg-gray-700 hover:bg-gray-800 px-3 py-1 rounded text-white">💨 Kalkulator Napas Sehat</a>
            </div>
        </div>

        <!-- 🔒 Login / User -->
        @auth
            <div x-data="{ open: false }" class="relative text-sm">
                <button @click="open = !open" class="bg-gray-200 text-gray-800 px-3 py-1 rounded hover:bg-gray-300">
                    {{ Auth::user()->name }}
                </button>
                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-40 bg-white text-black rounded shadow-md z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Keluar</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Login</a>
        @endauth
    </div>

    <!-- ✅ Page Heading -->
    @if (isset($header))
        <header class="bg-gray-800 text-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- ✅ Page Content -->
    <main>
        {{ $slot }}
    </main>

</body>
</html>
