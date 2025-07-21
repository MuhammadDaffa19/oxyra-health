<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-tr from-sky-400 via-blue-500 to-indigo-600 text-white px-4">
        <div class="w-full max-w-md bg-white text-gray-900 rounded-2xl shadow-2xl px-8 pt-10 pb-8">
            <div class="text-center mb-6">

                <!-- LOGO BULAT (seragam seperti register) -->
                <div class="w-32 h-32 mx-auto mb-10 mt-2 rounded-full overflow-hidden shadow-lg border-4 border-indigo-300">
                    <img src="{{ asset('images/OXYRA HEALTH.png') }}" alt="Logo" class="object-cover w-full h-full">
                </div>

                <div class="text-5xl mb-3 animate-pulse">🔐</div>
                <h2 class="text-3xl font-bold text-indigo-700">Selamat Datang Kembali</h2>
                <p class="text-base text-gray-500 mt-1">Silakan login untuk melanjutkan</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2 rounded border-gray-300">
                    <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition duration-200">
                    Masuk
                </button>

                <p class="mt-6 text-center text-sm text-gray-500">
                    Belum punya akun? <a href="{{ route('register') }}"
                        class="text-indigo-600 font-semibold hover:underline">Daftar Sekarang</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
