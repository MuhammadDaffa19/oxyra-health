<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-tr from-sky-400 via-blue-500 to-indigo-600 text-white px-4">
        <div class="w-full max-w-md bg-white text-gray-900 rounded-3xl shadow-xl px-8 pt-10 pb-8">
            <div class="text-center mb-6">

                <!-- LOGO BULAT -->
                <div class="w-28 h-28 mx-auto mb-6 rounded-full overflow-hidden shadow-lg border-4 border-indigo-300">
                    <img src="{{ asset('images/OXYRA HEALTH.png') }}" alt="Logo" class="object-cover w-full h-full">
                </div>

                <div class="text-5xl mb-3">📝</div>
                <h2 class="text-2xl font-bold text-indigo-700">Buat Akun Baru</h2>
                <p class="text-sm text-gray-500 mt-1">Daftarkan dirimu sekarang untuk mulai</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" type="text" name="name" required autofocus
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input id="password" type="password" name="password" required placeholder="Minimal 9 karakter"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    <p class="text-xs text-gray-500 mt-1 ml-1">Gunakan minimal 9 karakter untuk keamanan optimal.</p>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-semibold transition duration-200">
                    Daftar
                </button>

                <p class="mt-6 text-center text-sm text-gray-500">
                    Sudah punya akun? <a href="{{ route('login') }}"
                        class="text-indigo-600 font-semibold hover:underline">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
