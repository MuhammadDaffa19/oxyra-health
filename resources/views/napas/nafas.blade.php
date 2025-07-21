<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">💨 Kalkulator Napas Sehat</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-12 bg-white rounded-2xl shadow-xl text-gray-800">

        {{-- HEADER ICON HEART --}}
        <div class="text-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-600 mx-auto mb-4 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>

            <h3 class="text-3xl font-extrabold text-indigo-700 mb-3">⏱️ Seberapa Aman Napasmu di Luar Hari Ini?</h3>
            <p class="text-gray-600 text-lg">Masukkan nilai AQI dan kalkulasikan durasi aman untuk aktivitas di luar ruangan berdasarkan kualitas udara saat ini.</p>
        </div>

        {{-- FORM --}}
        <form id="napasForm" class="space-y-6">
            <div class="bg-indigo-50 p-6 rounded-xl border-l-4 border-indigo-500 shadow-sm relative">
                <label for="aqiInput" class="block text-lg font-semibold mb-2 text-gray-800">
                    🌫️ Nilai AQI Saat Ini <span class="text-sm text-gray-500">(0–500)</span>
                </label>
                <input type="number" id="aqiInput" name="aqi"
                        placeholder="Masukkan nilai AQI... contoh: 125"
                        class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-400 text-lg"
                        min="0" max="500">
                <p class="text-sm text-gray-500 mt-2">AQI (Air Quality Index) menentukan seberapa berbahaya kualitas udara terhadap kesehatan.</p>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-indigo-800 hover:from-indigo-700 hover:to-indigo-900 text-white font-semibold py-3 px-8 rounded-full shadow-md transition-all duration-200 hover:scale-105">
                    🔍 Hitung Durasi Aman
                </button>
            </div>
        </form>

        {{-- HASIL --}}
        <div id="resultBox" class="hidden mt-10 p-6 rounded-xl border shadow-lg transition-all duration-500 ease-in-out animate__animated animate__fadeInUp">
            <h4 class="text-xl font-bold text-indigo-800 mb-4 text-center">📊 Estimasi Waktu Aman Berdasarkan AQI</h4>
            
            {{-- Indikator visual level kualitas udara --}}
            <div class="relative w-full h-4 bg-gray-200 rounded-full mb-4 overflow-hidden">
                <div id="barLevel" class="absolute h-full rounded-full transition-all duration-500"></div>
            </div>

            <div id="resultCard" class="p-6 rounded-xl text-center bg-indigo-50 border border-indigo-200">
                <p id="resultText" class="text-lg font-semibold text-gray-700"></p>
            </div>

            <div class="text-center mt-6">
                <button id="resetBtn"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-full text-sm font-semibold shadow transition hover:scale-105">
                    🔁 Ulangi Perhitungan
                </button>
            </div>
        </div>

        {{-- BLOK EDUKASI --}}
        <div class="mt-12 p-6 bg-indigo-50 rounded-xl shadow border border-indigo-200">
            <h4 class="text-xl font-semibold text-indigo-700 mt-2">📖 Mengapa Penting Memantau AQI?</h4>
            <ul class="list-disc list-inside text-gray-700 leading-relaxed">
                <li>Kualitas udara buruk meningkatkan risiko ISPA, asma, dan gangguan jantung.</li>
                <li>Dengan mengetahui nilai AQI, kamu bisa menghindari paparan berbahaya.</li>
                <li>Masker dan durasi aktivitas luar harus disesuaikan dengan kondisi udara.</li>
            </ul>
        </div>
    </div>

    {{-- Animate.css CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script>
        const form = document.getElementById('napasForm');
        const resultBox = document.getElementById('resultBox');
        const resultText = document.getElementById('resultText');
        const resultCard = document.getElementById('resultCard');
        const resetBtn = document.getElementById('resetBtn');
        const barLevel = document.getElementById('barLevel');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const aqi = parseInt(document.getElementById('aqiInput').value);

            if (isNaN(aqi) || aqi < 0 || aqi > 500) {
                resultText.innerHTML = "<span class='text-red-600 font-semibold'>⚠️ Masukkan nilai AQI valid antara 0–500.</span>";
                resultCard.className = "p-6 rounded-xl bg-red-50 border border-red-200 text-center";
                barLevel.style.width = "0";
                barLevel.style.backgroundColor = "transparent";
                resultBox.classList.remove("hidden");
                return;
            }

            let message = "";
            let cardClass = "";
            let levelColor = "";
            let barWidth = (aqi / 500) * 100;

            if (aqi <= 50) {
                message = "✅ <span class='text-green-600 font-bold'>Udara Sangat Baik</span>. Bebas beraktivitas di luar.";
                cardClass = "bg-green-50 border-green-200";
                levelColor = "#22c55e";
            } else if (aqi <= 100) {
                message = "🟢 <span class='text-lime-600 font-bold'>Baik</span>. Aman hingga 8 jam di luar.";
                cardClass = "bg-lime-50 border-lime-200";
                levelColor = "#84cc16";
            } else if (aqi <= 150) {
                message = "🟡 <span class='text-yellow-500 font-bold'>Sedang</span>. Batasi hingga 4 jam, gunakan masker.";
                cardClass = "bg-yellow-50 border-yellow-200";
                levelColor = "#facc15";
            } else if (aqi <= 200) {
                message = "🟠 <span class='text-orange-500 font-bold'>Tidak Sehat</span>. Maks 1 jam, hindari olahraga.";
                cardClass = "bg-orange-50 border-orange-200";
                levelColor = "#f97316";
            } else if (aqi <= 300) {
                message = "🔴 <span class='text-red-600 font-bold'>Sangat Tidak Sehat</span>. Maks 30 menit di luar.";
                cardClass = "bg-red-50 border-red-200";
                levelColor = "#dc2626";
            } else {
                message = "☠️ <span class='text-pink-700 font-bold'>Berbahaya</span>. Jangan keluar rumah!";
                cardClass = "bg-pink-50 border-pink-200";
                levelColor = "#be185d";
            }

            resultText.innerHTML = message;
            resultCard.className = `p-6 rounded-xl border text-center ${cardClass}`;
            barLevel.style.width = barWidth + "%";
            barLevel.style.backgroundColor = levelColor;
            resultBox.classList.remove("hidden");
            resultBox.scrollIntoView({ behavior: "smooth" });
        });

        resetBtn.addEventListener("click", function () {
            document.getElementById("aqiInput").value = "";
            resultBox.classList.add("hidden");
            barLevel.style.width = "0";
            barLevel.style.backgroundColor = "transparent";
            window.scrollTo({ top: form.offsetTop, behavior: "smooth" });
        });
    </script>
</x-app-layout>
