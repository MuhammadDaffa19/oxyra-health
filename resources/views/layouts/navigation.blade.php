<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Judul atau logo teks -->
                <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Beranda</a>
            </div>

            <!-- Menu Fitur (jika login) -->
            @if(Auth::check())
                <div class="hidden sm:flex sm:items-center space-x-4">
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">⭐ Kota Favorit</a>
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">📈 Riwayat AQI</a>
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">🔔 Notifikasi</a>
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">📍 Lokasi Saya</a>
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">📊 Ringkasan</a>
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">⏱️ Snapshot</a>
                    <a href="#" class="text-sm text-gray-700 hover:text-blue-600 font-semibold">🗂️ Kelola Kota</a>
                </div>
            @endif

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded shadow">Login</a>
                @endif
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if(Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <!-- Fitur tambahan versi mobile -->
                <div class="mt-3 space-y-1 px-4">
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">⭐ Kota Favorit</a>
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">📈 Riwayat AQI</a>
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">🔔 Notifikasi</a>
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">📍 Lokasi Saya</a>
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">📊 Ringkasan</a>
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">⏱️ Snapshot</a>
                    <a href="#" class="block text-sm text-gray-700 hover:text-blue-600">🗂️ Kelola Kota</a>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Keluar
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <div class="text-gray-700 text-sm mb-2">Anda belum login.</div>
                    <a href="{{ route('login') }}" class="text-blue-600 underline text-sm">Login</a>
                </div>
            @endif
        </div>
    </div>
</nav>
