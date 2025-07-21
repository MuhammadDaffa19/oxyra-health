<x-app-layout>
    {{-- ✅ Pop-up Message --}}
    @if (session('status'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded shadow z-50"
        >
            {{ session('status') }}
            <button @click="show = false" class="ml-4 font-bold text-white">&times;</button>
        </div>
    @endif

    <div class="py-10 px-6 max-w-3xl mx-auto bg-gray-800 shadow-xl rounded-xl">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 text-center">🧑 Profil Saya</h2>

        {{-- ✅ Form Update Profile --}}
        <form method="post" action="{{ route('profile.update') }}" class="space-y-5 text-white">
            @csrf
            @method('patch')

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-semibold text-yellow-300 mb-1">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-yellow-500 focus:outline-none" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-yellow-300 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-yellow-500 focus:outline-none" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded font-semibold">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>

        {{-- 🔐 Form Ganti Password --}}
        <hr class="my-8 border-gray-600">
        <h3 class="text-2xl font-bold text-pink-400 text-center mb-6">🔐 Ubah Password</h3>

        <form method="post" action="{{ route('password.update') }}" class="space-y-5 text-white">
            @csrf
            @method('put')

            <!-- Password Lama -->
            <div>
                <label for="current_password" class="block text-sm font-semibold text-pink-300 mb-1">Password Lama</label>
                <input id="current_password" name="current_password" type="password"
                    class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-pink-500 focus:outline-none" required>
            </div>

            <!-- Password Baru -->
            <div>
                <label for="password" class="block text-sm font-semibold text-pink-300 mb-1">Password Baru</label>
                <input id="password" name="password" type="password"
                    class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-pink-500 focus:outline-none" required>
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-pink-300 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-pink-500 focus:outline-none" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-black px-4 py-2 rounded font-semibold">
                    🔄 Ubah Password
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
