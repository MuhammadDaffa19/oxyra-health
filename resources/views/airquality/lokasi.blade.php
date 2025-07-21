<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">📍 Lokasi Saya</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-6 py-10 bg-white shadow-xl rounded-2xl text-gray-800">
        <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-blue-700 mb-2">🎯 Deteksi Kualitas Udara Berdasarkan Lokasi</h3>
        <p class="text-gray-600">Klik tombol di bawah untuk mulai mendeteksi kualitas udara berdasarkan lokasi Anda.</p>
        </div>

        <div class="flex justify-center mb-8">
        <button id="btn-get-location" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-3 rounded-full shadow hover:scale-105 transition-all duration-200 font-semibold text-lg flex items-center gap-2">
            Deteksi Lokasi Sekarang
        </button>
        </div>

        <div id="loadingBox" class="hidden text-center text-blue-600 font-semibold mb-6 animate-pulse">
        🔄 Mendapatkan data kualitas udara...
        </div>

        <div id="location-result" class="hidden transition-all duration-300 ease-in-out">
        <div id="result-card" class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-white to-blue-50 border border-blue-200 mb-6">
            <h4 class="text-xl font-bold mb-2 text-blue-800">📍 Lokasi Anda: <span id="user-location"></span></h4>
            <p class="text-lg">🌫️ <strong>AQI:</strong> <span id="user-aqi"></span></p>
            <p class="text-lg">🔬 <strong>Polutan Utama:</strong> <span id="user-polutan"></span></p>
            <p class="text-lg mt-2">📌 <span id="user-advice"></span></p>
        </div>

        <div class="mt-6 bg-blue-50 p-5 rounded-md border border-blue-200 mb-8">
            <h3 class="text-lg font-bold text-blue-800 mb-2">💡 Tips Kesehatan</h3>
            <ul id="tipsList" class="list-disc pl-5 text-gray-800 space-y-1"></ul>
        </div>

        <div>
            <h3 class="text-lg font-bold text-blue-800 mb-2">📊 Grafik Tren AQI 7 Hari</h3>
            <canvas id="aqiChart" class="bg-white rounded shadow-md p-6"></canvas>
        </div>
        <p class="text-base text-gray-600 italic mt-3">
            *Catatan: Grafik menggunakan data rata-rata harian dari Weatherbit. Nilai bisa berbeda dengan AQI real-time.
        </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const WEATHERBIT_API_KEY = "{{ $weatherbitKey }}"; // Didefinisikan dari Blade

        async function fetchHistoricalAQI(lat, lng) {
            const end = new Date();
            const start = new Date();
            start.setDate(end.getDate() - 6);
            const fmt = d => d.toISOString().slice(0,10);
            const res = await axios.get(`https://api.weatherbit.io/v2.0/history/airquality`, {
                params: {
                    lat,
                    lon: lng,
                    start_date: fmt(start),
                    end_date: fmt(end),
                    key: WEATHERBIT_API_KEY,
                    tz: 'local'
                }
            });
            return res.data.data;
        }

        function getAQILevel(aqi) {
            if (aqi <= 50) return { label: "Baik", color: "green", advice: "✅ Udara sehat untuk semua." };
            if (aqi <= 100) return { label: "Sedang", color: "yellow", advice: "⚠️ Sensitif gunakan masker." };
            if (aqi <= 150) return { label: "Tidak Sehat untuk Sensitif", color: "orange", advice: "🚫 Kurangi aktivitas luar." };
            if (aqi <= 200) return { label: "Tidak Sehat", color: "red", advice: "❗ Batasi aktivitas luar." };
            if (aqi <= 300) return { label: "Sangat Tidak Sehat", color: "purple", advice: "🚫 Hindari keluar rumah." };
            return { label: "Berbahaya", color: "maroon", advice: "☠️ Tetap di dalam rumah." };
        }

        function displayHealthTips(aqiLabel) {
            const tips = {
                "Baik": [
                    "🌿 Udara dalam kondisi baik, cocok untuk olahraga di luar ruangan.",
                    "💧 Tetap jaga hidrasi dengan minum air putih cukup.",
                    "🏃 Nikmati aktivitas luar seperti jogging atau bersepeda!"
                ],
                "Sedang": [
                    "😷 Jika memiliki alergi atau asma, gunakan masker saat keluar.",
                    "🥗 Perkuat daya tahan tubuh dengan makanan bergizi.",
                    "🌬️ Hindari area dengan lalu lintas padat atau berdebu."
                ],
                "Tidak Sehat untuk Sensitif": [
                    "🚫 Kurangi aktivitas luar, terutama untuk anak-anak dan lansia.",
                    "😷 Gunakan masker KN95 saat berada di luar ruangan.",
                    "🍵 Minum air hangat atau teh herbal untuk menjaga saluran napas."
                ],
                "Tidak Sehat": [
                    "❗ Hindari aktivitas di luar rumah kecuali sangat perlu.",
                    "🏠 Tetap di dalam ruangan dengan ventilasi tertutup.",
                    "🧴 Gunakan pelembap udara atau purifier jika tersedia."
                ],
                "Sangat Tidak Sehat": [
                    "🚫 Hindari keluar rumah untuk aktivitas apapun.",
                    "📞 Segera hubungi dokter jika mengalami sesak napas.",
                    "🧼 Jaga kebersihan lingkungan dalam rumah dan tutup semua ventilasi."
                ],
                "Berbahaya": [
                    "☠️ Tetap berada di dalam rumah sepanjang waktu.",
                    "📢 Pantau informasi dan peringatan dari otoritas kesehatan.",
                    "🚨 Persiapkan masker darurat dan air bersih jika kondisi memburuk."
                ]
            }[aqiLabel] || [];

            const ul = document.getElementById('tipsList');
            ul.innerHTML = tips.map(t => `<li>${t}</li>`).join('');
        }

        function renderChart(hist) {
            const daily = Object.values(hist.reduce((a, c) => {
                const day = c.timestamp_local.split('T')[0];
                if (!a[day] || c.ts > a[day].ts) a[day] = c;
                return a;
            }, {}));

            const labels = daily.map(d => new Date(d.timestamp_local).toLocaleDateString('id-ID', {
                weekday: 'short',
                day: 'numeric',
                month: 'short'
            }));
            const vals = daily.map(d => d.aqi);

            const chartEl = document.getElementById('aqiChart');
            if (!chartEl) return console.warn("Element grafik tidak ditemukan.");

            new Chart(chartEl, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'AQI',
                        data: vals,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: Math.max(...vals) + 30
                        }
                    }
                }
            });
        }

        document.getElementById('btn-get-location').addEventListener('click', async () => {
            const loading = document.getElementById('loadingBox'),
                result = document.getElementById('location-result');
            loading.classList.remove('hidden');
            result.classList.add('hidden');

            if (!navigator.geolocation) {
                alert('Geolocation tidak tersedia.');
                loading.classList.add('hidden');
                return;
            }

            navigator.geolocation.getCurrentPosition(async pos => {
                const lat = pos.coords.latitude,
                    lng = pos.coords.longitude;
                const info = await axios.get(`/search-city?city=${lat},${lng}`);
                const d = info.data,
                    lvl = getAQILevel(d.aqi);

                document.getElementById('user-location').textContent = d.city;
                document.getElementById('user-aqi').textContent = `${d.aqi} (${lvl.label})`;
                document.getElementById('user-polutan').textContent = d.dominentpol?.toUpperCase() || '-';
                document.getElementById('user-advice').textContent = lvl.advice;
                document.getElementById('result-card').style.borderColor = lvl.color;
                displayHealthTips(lvl.label);

                try {
                    const hist = await fetchHistoricalAQI(lat, lng);
                    renderChart(hist);
                } catch {
                    console.warn('Gagal ambil histori AQI.');
                }

                loading.classList.add('hidden');
                result.classList.remove('hidden');
            }, () => {
                alert('Izin lokasi dibutuhkan.');
                loading.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
