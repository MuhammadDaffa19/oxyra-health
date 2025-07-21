<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>💧 Oxyra Health</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen px-4 py-6 text-[1.05rem] leading-relaxed">

    <!-- ✅ TOP BAR -->
    <div class="flex justify-between items-center mb-6 w-full relative">
        <!-- KIRI: Logo Bulat + Judul -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/OXYRA HEALTH.png') }}"
                alt="Logo"
                class="w-24 h-24 object-cover rounded-full border-2 border-white shadow-md" />
            <h1 class="text-2xl md:text-3xl font-extrabold whitespace-nowrap">📌 Peta Kualitas Udara Global</h1>
        </div>

        <!-- TENGAH: Pesan Login (mobile & desktop) -->
        @guest
        <div class="hidden md:block flex-grow text-center text-yellow-300 font-bold text-base md:text-lg">
            Jika ingin fitur lebih, silakan login.
        </div>
        @endguest

        <!-- KANAN: Menu Desktop dan Mobile Toggle -->
        <div class="flex items-center space-x-3">
            <!-- Toggle Menu Mobile -->
            <button id="menuToggle" class="md:hidden text-white text-3xl focus:outline-none">
                ☰
            </button>

            <!-- Menu Items -->
            <div id="menuItems"
                class="hidden md:flex flex-wrap justify-end space-x-2 items-center text-[0.95rem] absolute top-full right-0 md:static bg-gray-900 md:bg-transparent mt-2 md:mt-0 p-4 md:p-0 rounded shadow-lg md:shadow-none z-50 w-64 md:w-auto">
                @auth
                    <a href="{{ route('favorite.index') }}" class="block bg-emerald-600 hover:bg-emerald-700 px-3 py-2 rounded text-white w-full md:w-auto text-left">⭐ Kota Favorit</a>
                    <a href="{{ route('tips.kesehatan') }}" class="block bg-yellow-600 hover:bg-yellow-700 px-3 py-2 rounded text-white w-full md:w-auto text-left">💡 Tips Kesehatan</a>
                    <a href="{{ route('tips.edukasi') }}" class="block bg-pink-600 hover:bg-pink-700 px-3 py-2 rounded text-white w-full md:w-auto text-left">📘 Edukasi Polusi & ISPA</a>
                    <a href="{{ route('lokasi.saya') }}" class="block bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded text-white w-full md:w-auto text-left">📍 Lokasi Saya</a>
                    <a href="{{ route('cek.ispa') }}" class="block bg-indigo-600 hover:bg-indigo-700 px-3 py-2 rounded text-white w-full md:w-auto text-left">🩺 Cek Risiko ISPA</a>
                    <a href="{{ route('napas.nafas') }}" class="block bg-gray-700 hover:bg-gray-800 px-3 py-2 rounded text-white w-full md:w-auto text-left">💨 Kalkulator Napas Sehat</a>

                    <div class="relative group w-full md:w-auto">
                        <button class="bg-gray-200 text-gray-800 px-3 py-2 rounded w-full text-left">{{ Auth::user()->name }}</button>
                        <div class="absolute right-0 mt-1 w-40 bg-white text-gray-800 rounded shadow-lg hidden group-hover:block z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow w-full md:w-auto text-left">Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- ✅ FORM PENCARIAN -->
    <div class="flex items-center mb-6 space-x-2">
        <input type="text" id="search" placeholder="Masukkan nama kota..." class="w-full p-3 rounded text-black text-lg" />
        <button id="btn-search" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded text-lg font-semibold">Cari Kota</button>
    </div>

    <!-- ✅ HASIL PENCARIAN -->
    <div id="results" class="mb-4 space-y-2 text-base leading-relaxed"></div>

    <!-- ✅ FORM FAVORIT -->
    <div id="favoriteWrapper" class="mt-4 hidden">
        <form id="favoriteForm" method="POST" action="{{ route('favorite.store') }}">
            @csrf
            <input type="hidden" name="city_name" id="fav_city_name">
            <input type="hidden" name="state" id="fav_state">
            <input type="hidden" name="country" id="fav_country">
            <input type="hidden" name="country_code" id="fav_country_code">
            <input type="hidden" name="lat" id="fav_lat">
            <input type="hidden" name="lng" id="fav_lng">

            @auth
                <button type="submit"
                    id="favButton"
                    class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded text-sm text-black font-semibold">
                    ⭐ Simpan ke Favorit
                </button>
            @endauth

            @guest
                <button type="button"
                    onclick="alert('Silakan login untuk menyimpan kota favorit.')"
                    class="bg-yellow-300 text-black px-4 py-2 rounded text-sm font-semibold cursor-not-allowed opacity-70"
                    disabled>
                    ⭐ Simpan ke Favorit
                </button>
                <p class="text-sm text-gray-400 font-bold mt-1">Login untuk menyimpan kota favorit.</p>
            @endguest

            <p id="favStatus" class="text-sm mt-2 text-green-300 font-semibold"></p>
        </form>
    </div>

    <!-- ✅ PETA -->
    <div id="map" class="w-full h-[500px] rounded shadow-md mt-6"></div>

    <!-- ✅ LEGENDA -->
    <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 text-center text-base font-medium">
        <div class="bg-green-500 text-white rounded py-2">Baik</div>
        <div class="bg-yellow-400 text-black rounded py-2">Sedang</div>
        <div class="bg-orange-500 text-white rounded py-2">Tidak Sehat untuk Kelompok Sensitif</div>
        <div class="bg-red-600 text-white rounded py-2">Tidak Sehat</div>
        <div class="bg-purple-700 text-white rounded py-2">Sangat Tidak Sehat</div>
        <div class="bg-rose-900 text-white rounded py-2">Berbahaya</div>
    </div>

    <!-- ✅ LOADING OVERLAY -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden items-center justify-center">
        <div class="text-center text-white">
            <div class="text-2xl font-bold mb-4">⏳ Tunggu sebentar...</div>
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-white border-t-transparent mx-auto"></div>
        </div>
    </div>

    <!-- ✅ TIPS KESEHATAN DINAMIS -->
    <div id="healthTips" class="bg-white p-6 rounded shadow max-w-2xl mx-auto mt-8 hidden">
        <h2 class="text-xl font-extrabold text-green-700 mb-3">💡 Tips Kesehatan Berdasarkan AQI</h2>
        <ul id="tipsList" class="list-disc pl-6 text-base text-gray-800 space-y-2 leading-relaxed"></ul>
    </div>

    <!-- 🔔 Notifikasi Bahaya AQI -->
    <div id="aqiWarningPopup" class="hidden fixed top-5 right-5 z-50 bg-red-600 text-white px-5 py-4 rounded shadow-lg animate-pulse">
        ⚠️ <strong>Peringatan Bahaya!</strong><br>
        Kualitas udara sangat tidak sehat (AQI > 150). Sebaiknya tetap di dalam ruangan dan gunakan masker jika keluar.
    </div>

    <!-- ✅ SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css">

    <script>
        const map = L.map('map').setView([-2.5, 117], 4);
        const MAPTILER_KEY = '{{ $maptilerKey }}';

        L.tileLayer(`https://api.maptiler.com/maps/basic-v2/256/{z}/{x}/{y}.png?key=${MAPTILER_KEY}`, {
            attribution: '&copy; MapTiler & OpenStreetMap contributors'
        }).addTo(map);

        let currentMarker = null;
        let markerCluster = L.markerClusterGroup();
        map.addLayer(markerCluster);

        function getAQILevel(aqi) {
            if (aqi <= 50) return { label: "Baik", color: "green" };
            if (aqi <= 100) return { label: "Sedang", color: "yellow" };
            if (aqi <= 150) return { label: "Tidak Sehat untuk Kelompok Sensitif", color: "orange" };
            if (aqi <= 200) return { label: "Tidak Sehat", color: "red" };
            if (aqi <= 300) return { label: "Sangat Tidak Sehat", color: "purple" };
            return { label: "Berbahaya", color: "maroon" };
        }

        function showLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.remove('flex');
            overlay.classList.add('hidden');
        }

        function displayHealthTips(aqi) {
            const tipsMap = {
                "Baik": [
                    "🌿 Udara baik! Lakukan olahraga luar ruangan seperti jogging atau bersepeda.",
                    "🌤️ Manfaatkan hari ini untuk aktivitas luar rumah bersama keluarga.",
                    "🥦 Tetap jaga pola makan sehat & olahraga rutin."
                ],
                "Sedang": [
                    "😷 Jika kamu sensitif (asma, ISPA), gunakan masker saat di luar.",
                    "🌬️ Hindari area berdebu atau lalu lintas padat.",
                    "🍊 Konsumsi buah tinggi antioksidan seperti jeruk dan kiwi."
                ],
                "Tidak Sehat untuk Kelompok Sensitif": [
                    "🚫 Kurangi aktivitas di luar rumah.",
                    "😷 Gunakan masker KN95 saat keluar rumah.",
                    "🍵 Minum air hangat & herbal seperti jahe untuk menjaga paru-paru."
                ],
                "Tidak Sehat": [
                    "❗ Batasi aktivitas luar ruangan sebisa mungkin.",
                    "😷 Gunakan masker berkualitas tinggi.",
                    "🏠 Tutup jendela dan gunakan air purifier jika tersedia."
                ],
                "Sangat Tidak Sehat": [
                    "🚫 Hindari keluar rumah.",
                    "🧼 Gunakan masker saat terpaksa keluar.",
                    "💊 Periksa kesehatan jika merasa sesak napas atau lelah ekstrem."
                ],
                "Berbahaya": [
                    "☠️ Tetap di dalam rumah dan tutup semua ventilasi.",
                    "📢 Ikuti instruksi darurat dari pemerintah.",
                    "📞 Hubungi tenaga medis jika mengalami gejala pernapasan serius."
                ]
            };

            const level = getAQILevel(aqi);
            const tips = tipsMap[level.label] || [];
            const tipsList = document.getElementById("tipsList");

            if (!tipsList) return;

            tipsList.innerHTML = "";
            tips.forEach(tip => {
                const li = document.createElement("li");
                li.textContent = tip;
                tipsList.appendChild(li);
            });

            const healthTipsBox = document.getElementById("healthTips");
            if (healthTipsBox) {
                healthTipsBox.classList.remove("hidden");
            }
        }

        function showAqiWarning(aqi) {
            const popup = document.getElementById("aqiWarningPopup");
            if (aqi > 150 && popup) {
                popup.classList.remove("hidden");

                setTimeout(() => {
                    popup.classList.add("hidden");
                }, 10000);
            }
        }

        async function searchCityAndDisplay(cityQuery) {
            showLoading();

            try {
                const res = await axios.get(`/search-city?city=${encodeURIComponent(cityQuery)}`);
                const data = res.data;
                const level = getAQILevel(data.aqi);

                if (currentMarker) markerCluster.removeLayer(currentMarker);
                map.setView([data.lat, data.lng], 10);
                currentMarker = L.marker([data.lat, data.lng])
                    .bindPopup(`<b>${data.city}</b><br>AQI: ${data.aqi} (${level.label})`);
                markerCluster.addLayer(currentMarker);
                currentMarker.openPopup();

                const advice = {
                    "Baik": "✅ Udara sehat untuk semua.",
                    "Sedang": "⚠️ Aman bagi kebanyakan orang, hati-hati untuk kelompok sensitif.",
                    "Tidak Sehat untuk Kelompok Sensitif": "⚠️ Orang dengan penyakit pernapasan sebaiknya membatasi aktivitas di luar.",
                    "Tidak Sehat": "❗ Hindari aktivitas luar ruangan sebisa mungkin.",
                    "Sangat Tidak Sehat": "🚫 Aktivitas luar sangat tidak disarankan.",
                    "Berbahaya": "☠️ Bahaya serius bagi kesehatan semua orang."
                };

                document.getElementById('results').innerHTML = `
                    <div class="p-4 rounded shadow text-black font-semibold" style="background-color: ${level.color};">
                        <h2 class="text-lg font-bold">🌍 ${data.flag ?? ''} ${data.city}</h2>
                        <p>🌫️ AQI: <strong>${data.aqi}</strong> (${level.label})</p>
                        <p>🔬 Polutan utama: ${data.dominentpol?.toUpperCase() || '-'}</p>
                        <p>📌 ${advice[level.label]}</p>
                    </div>
                `;

                document.getElementById('favoriteWrapper').classList.remove('hidden');
                document.getElementById('fav_city_name').value = data.city_name;
                document.getElementById('fav_state').value = data.state;
                document.getElementById('fav_country').value = data.country;
                document.getElementById('fav_country_code').value = data.country_code;
                document.getElementById('fav_lat').value = data.lat;
                document.getElementById('fav_lng').value = data.lng;

                displayHealthTips(data.aqi);
                showAqiWarning(data.aqi);

            } catch (err) {
                alert("Kota tidak ditemukan atau terjadi kesalahan.");
            } finally {
                hideLoading();
            }
        }

        document.getElementById('btn-search').addEventListener('click', async () => {
            const city = document.getElementById('search').value.trim();
            if (city.length < 2) return;
            await searchCityAndDisplay(city);
        });

        document.addEventListener("DOMContentLoaded", () => {
            const params = new URLSearchParams(window.location.search);
            const city = params.get('city');
            if (city) {
                searchCityAndDisplay(city);
            }
        });

        @auth
        document.getElementById('favoriteForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const button = form.querySelector('button');
            const formData = new FormData(form);
            const statusMsg = document.getElementById('favStatus');

            button.disabled = true;
            statusMsg.innerText = "⏳ Menyimpan kota...";

            try {
                const response = await axios.post("/favorite-cities", formData, {
                    headers: { 'Accept': 'application/json' }
                });

                if (response.status === 200 || response.status === 201) {
                    statusMsg.innerText = "✅ Kota berhasil disimpan ke favorit!";
                }

            } catch (error) {
                if (error.response && error.response.status === 409) {
                    statusMsg.innerText = "⚠️ Kota sudah ada di daftar favorit.";
                } else {
                    statusMsg.innerText = "⚠️ Terjadi kesalahan saat menyimpan.";
                }
                button.disabled = false;
            }
        });
        @endauth

        document.getElementById('menuToggle')?.addEventListener('click', () => {
            const menu = document.getElementById('menuItems');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
