<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">💡 Tips Kesehatan Berdasarkan AQI</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-green-700 mb-2">💡 Tips Kesehatan Real-Time</h2>
            <p class="text-base text-gray-700 leading-relaxed">
                Dapatkan saran kesehatan berdasarkan tingkat polusi udara (AQI) di kota kamu.
            </p>
        </div>

        {{-- Bagian tips dinamis --}}
        <div id="healthTipsDynamic" class="space-y-6 text-[15px] leading-relaxed">

            {{-- AQI Baik --}}
            <div class="bg-green-100 border-l-4 border-green-500 p-5 rounded-md">
                <h3 class="text-lg font-semibold text-green-800 mb-2">✅ Udara Baik (AQI 0–50)</h3>
                <ul class="list-disc pl-5 text-green-900 space-y-1">
                    <li>🌿 Udara baik! Lakukan olahraga luar ruangan seperti jogging atau bersepeda.</li>
                    <li>🌤️ Manfaatkan hari ini untuk aktivitas luar rumah bersama keluarga.</li>
                    <li>🥦 Tetap jaga pola makan sehat & olahraga rutin.</li>
                </ul>
            </div>

            {{-- AQI Sedang --}}
            <div class="bg-yellow-100 border-l-4 border-yellow-500 p-5 rounded-md">
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">⚠️ Udara Sedang (AQI 51–100)</h3>
                <ul class="list-disc pl-5 text-yellow-900 space-y-1">
                    <li>😷 Jika kamu sensitif (asma, ISPA), gunakan masker saat di luar.</li>
                    <li>🌬️ Hindari area berdebu atau lalu lintas padat.</li>
                    <li>🍊 Konsumsi buah tinggi antioksidan seperti jeruk dan kiwi.</li>
                </ul>
            </div>

            {{-- AQI Tidak Sehat untuk Kelompok Sensitif --}}
            <div class="bg-orange-100 border-l-4 border-orange-400 p-5 rounded-md">
                <h3 class="text-lg font-semibold text-orange-800 mb-2">❗ Tidak Sehat untuk Kelompok Sensitif (AQI 101–150)</h3>
                <ul class="list-disc pl-5 text-orange-900 space-y-1">
                    <li>🚫 Hindari aktivitas berat di luar ruangan bagi penderita asma atau ISPA.</li>
                    <li>😷 Gunakan masker saat keluar rumah.</li>
                    <li>🏠 Kurangi ventilasi terbuka jika dekat jalan besar.</li>
                </ul>
            </div>

            {{-- AQI Tidak Sehat --}}
            <div class="bg-red-100 border-l-4 border-red-500 p-5 rounded-md">
                <h3 class="text-lg font-semibold text-red-800 mb-2">❗ Tidak Sehat (AQI 151–200)</h3>
                <ul class="list-disc pl-5 text-red-900 space-y-1">
                    <li>🚷 Batasi aktivitas luar ruangan sebisa mungkin.</li>
                    <li>😷 Gunakan masker KN95 atau N95 saat harus keluar rumah.</li>
                    <li>🏠 Tutup jendela dan gunakan pembersih udara jika ada.</li>
                    <li>🍵 Minum air hangat & herbal untuk menjaga kesehatan paru-paru.</li>
                </ul>
            </div>

            {{-- AQI Sangat Tidak Sehat --}}
            <div class="bg-purple-100 border-l-4 border-purple-600 p-5 rounded-md">
                <h3 class="text-lg font-semibold text-purple-800 mb-2">🚫 Sangat Tidak Sehat (AQI 201–300)</h3>
                <ul class="list-disc pl-5 text-purple-900 space-y-1">
                    <li>🚫 Hindari semua aktivitas luar ruangan.</li>
                    <li>😷 Gunakan masker filtrasi tinggi di kondisi darurat keluar.</li>
                    <li>💊 Konsultasikan ke dokter jika muncul gejala sesak atau batuk berat.</li>
                </ul>
            </div>

            {{-- AQI Berbahaya --}}
            <div class="bg-rose-100 border-l-4 border-rose-700 p-5 rounded-md">
                <h3 class="text-lg font-semibold text-rose-800 mb-2">☠️ Berbahaya (AQI 301+)</h3>
                <ul class="list-disc pl-5 text-rose-900 space-y-1">
                    <li>⚠️ Kondisi darurat! Semua orang berisiko terpapar dampak serius.</li>
                    <li>🚪 Tutup ventilasi, pintu, dan jendela rapat-rapat.</li>
                    <li>📻 Ikuti pengumuman darurat dari pemerintah setempat.</li>
                    <li>🧑‍⚕️ Segera cari pertolongan medis jika mengalami sesak napas atau nyeri dada.</li>
                </ul>
            </div>

        </div>

        {{-- Info Edukatif --}}
        <div class="mt-10 bg-blue-50 border-l-4 border-blue-400 p-5 rounded-md text-[15px] leading-relaxed">
            <h4 class="text-base font-semibold text-blue-700">Kenapa AQI itu penting?</h4>
            <p class="mt-1 text-blue-700">
                Indeks Kualitas Udara (AQI) menunjukkan seberapa bersih atau tercemarnya udara. Angka tinggi berarti polusi meningkat, yang bisa menyebabkan ISPA, asma, bahkan kerusakan jangka panjang jika terpapar terus menerus.
            </p>
            <a href="https://ayosehat.kemkes.go.id/bahaya-polusi-udara-bagi-kesehatan" class="inline-block mt-2 text-blue-600 hover:underline">Pelajari lebih lanjut tentang dampak polusi udara →</a>
        </div>

        {{-- FAQ --}}
        <div class="mt-10 bg-gray-100 border-l-4 border-gray-400 p-5 rounded-md text-[15px] text-gray-800 leading-relaxed">
            <h4 class="text-base font-semibold mb-3">❓ Pertanyaan Umum (FAQ)</h4>
            <div class="space-y-4">
                <div>
                    <p class="font-semibold">Apa itu AQI?</p>
                    <p>AQI (Air Quality Index) adalah indeks yang digunakan untuk menggambarkan seberapa bersih atau tercemarnya udara di suatu lokasi.</p>
                </div>
                <div>
                    <p class="font-semibold">Seberapa sering data AQI diperbarui?</p>
                    <p>Bergantung pada penyedia data, umumnya setiap 1 jam atau real-time di beberapa lokasi.</p>
                </div>
                <div>
                    <p class="font-semibold">Apa polutan paling berbahaya?</p>
                    <p>PM2.5 (partikel halus) adalah salah satu yang paling berbahaya karena bisa masuk langsung ke paru-paru dan aliran darah.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
