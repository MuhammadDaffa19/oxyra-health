<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">📘 Edukasi Polusi & ISPA</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-lg text-[15px] leading-relaxed">
        <!-- 📖 Informasi Utama -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-blue-800 mb-3">Apa itu Polusi Udara?</h3>
            <p class="text-gray-800 mb-4">
                Polusi udara merupakan kondisi tercemarnya udara oleh zat-zat kimia, fisik, atau biologis yang berdampak buruk pada kesehatan manusia, hewan, tumbuhan, serta ekosistem secara keseluruhan. Sumber utama polusi udara termasuk asap kendaraan bermotor, pembakaran bahan bakar fosil, industri manufaktur, serta pembakaran sampah rumah tangga. Polusi udara terdiri dari berbagai partikel dan gas berbahaya seperti karbon monoksida (CO), nitrogen dioksida (NO₂), sulfur dioksida (SO₂), ozon (O₃) di permukaan tanah, serta partikulat halus (PM2.5 dan PM10).
            </p>

            <h3 class="text-xl font-bold text-blue-800 mb-3">Dampak Polusi Terhadap Kesehatan</h3>
            <p class="text-gray-800 mb-4">
                Dampak polusi udara terhadap kesehatan sangat serius, terutama jika paparan terjadi secara terus-menerus dalam jangka waktu lama. Polusi udara dapat menyebabkan:
            </p>
            <ul class="list-disc list-inside text-gray-800 mb-4">
                <li><strong>ISPA (Infeksi Saluran Pernapasan Akut):</strong> Ditandai dengan batuk, sesak napas, demam, dan sakit tenggorokan. Anak-anak dan lansia sangat rentan karena sistem imun mereka lebih lemah.</li>
                <li><strong>Asma dan bronkitis kronis:</strong> Polutan seperti PM2.5 dan ozon dapat memicu kambuhnya gejala pada penderita asma serta memperburuk kondisi paru-paru.</li>
                <li><strong>Penyakit jantung:</strong> Partikel halus dapat masuk ke aliran darah melalui paru-paru, meningkatkan risiko penyakit jantung koroner dan stroke.</li>
                <li><strong>Kanker paru-paru:</strong> Paparan jangka panjang terhadap polusi udara, terutama di lingkungan industri, berpotensi menyebabkan mutasi sel dan kanker paru.</li>
                <li><strong>Penurunan fungsi kognitif:</strong> Beberapa penelitian menunjukkan bahwa paparan polusi udara kronis dapat menurunkan fungsi otak, terutama pada anak-anak dan lansia.</li>
            </ul>
            <p class="text-gray-800">
                Untuk melindungi diri, penting bagi masyarakat untuk memahami AQI (Air Quality Index) dan mengambil tindakan pencegahan seperti menggunakan masker berkualitas saat udara buruk, menjaga ventilasi rumah, dan memantau kondisi udara secara real-time.
            </p>
        </div>

        <!-- 🧠 Infografis -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-blue-800 mb-3">Infografis: Jalur Dampak Polusi Udara</h3>
            <img src="{{ asset('images/infografis-polusi.jpg') }}" alt="Infografis Polusi Udara" class="max-w-md w-full mx-auto rounded shadow-md">
            <p class="text-5 text-center text-gray-500 mt-2">*Ilustrasi sederhana tentang bagaimana polusi udara berdampak pada tubuh manusia</p>
        </div>

        <!-- 🎓 FAQ Accordion -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-blue-800 mb-3">Pertanyaan Umum (FAQ)</h3>
            <div class="space-y-3" x-data="{ open: null }">
                <!-- FAQ 1 -->
                <div class="border rounded-md">
                    <button @click="open === 1 ? open = null : open = 1" class="w-full text-left px-4 py-2 font-semibold bg-blue-100 hover:bg-blue-200 text-black">
                        Apa itu ISPA dan bagaimana kaitannya dengan polusi udara?
                    </button>
                    <div x-show="open === 1" class="px-4 py-2 text-gray-700">
                        ISPA (Infeksi Saluran Pernapasan Akut) adalah sekelompok infeksi yang menyerang saluran pernapasan, termasuk hidung, tenggorokan, bronkus, dan paru-paru. Gejalanya meliputi batuk, demam, pilek, nyeri tenggorokan, hingga sesak napas. 
                        <br><br>
                        Polusi udara, terutama partikel halus seperti PM2.5 dan PM10, dapat memperburuk kondisi ISPA karena menembus sistem pernapasan dan menyebabkan iritasi, peradangan, serta menurunkan imunitas saluran napas. Paparan berkepanjangan meningkatkan risiko ISPA berulang atau kronis.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border rounded-md">
                    <button @click="open === 2 ? open = null : open = 2" class="w-full text-left px-4 py-2 font-semibold bg-blue-100 hover:bg-blue-200 text-black">
                        Siapa yang paling rentan terkena dampak polusi udara?
                    </button>
                    <div x-show="open === 2" class="px-4 py-2 text-gray-700">
                        Beberapa kelompok populasi lebih rentan terhadap dampak buruk polusi udara, di antaranya:
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li><strong>Anak-anak</strong> – Saluran napas mereka masih berkembang dan bernapas lebih cepat, sehingga lebih banyak menyerap polutan.</li>
                            <li><strong>Lansia</strong> – Umumnya memiliki daya tahan tubuh dan fungsi paru yang menurun, sehingga lebih sensitif terhadap polusi.</li>
                            <li><strong>Penderita asma, ISPA, atau penyakit paru</strong> – Polusi udara bisa memperburuk gejala dan memicu serangan akut.</li>
                            <li><strong>Individu dengan penyakit jantung</strong> – Paparan polutan dapat meningkatkan tekanan darah dan risiko serangan jantung.</li>
                            <li><strong>Ibu hamil</strong> – Paparan tinggi dapat mempengaruhi perkembangan janin dan meningkatkan risiko komplikasi kehamilan.</li>
                        </ul>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border rounded-md">
                    <button @click="open === 3 ? open = null : open = 3" class="w-full text-left px-4 py-2 font-semibold bg-blue-100 hover:bg-blue-200 text-black">
                        Apa yang bisa saya lakukan untuk mengurangi dampak polusi?
                    </button>
                    <div x-show="open === 3" class="px-4 py-2 text-gray-700">
                        Untuk mengurangi risiko kesehatan akibat polusi udara, berikut beberapa langkah efektif yang bisa Anda lakukan:
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Gunakan <strong>masker N95</strong> atau setara saat keluar rumah, terutama saat AQI tinggi atau ada kabut asap.</li>
                            <li>Kurangi aktivitas fisik berat di luar ruangan saat polusi tinggi, terutama olahraga atau berkendara di jalanan ramai.</li>
                            <li>Tutup jendela dan ventilasi jika AQI buruk, dan nyalakan <strong>air purifier</strong> di dalam rumah jika tersedia.</li>
                            <li>Hindari membakar sampah atau menggunakan bahan bakar padat (kayu, arang) di rumah karena meningkatkan emisi dalam ruangan.</li>
                            <li>Ikuti informasi kualitas udara harian melalui aplikasi atau website pemantauan AQI.</li>
                            <li>Dukung transportasi ramah lingkungan seperti jalan kaki, bersepeda, atau transportasi publik untuk mengurangi emisi kendaraan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🧩 Kuis Interaktif: Tes Pengetahuanmu -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-blue-800 mb-4">🎮 Coba Tes Pengetahuanmu tentang Polusi & Kesehatan!</h3>
            <div class="bg-gray-50 border border-gray-200 rounded-md p-4 text-black" id="quizGame">
                <div id="questionContainer" class="space-y-3">
                    <p id="questionText" class="font-semibold text-gray-800">🔍 Pertanyaan akan muncul di sini...</p>
                    <div id="answerOptions" class="space-y-2"></div>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <button id="nextBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded hidden">Pertanyaan Selanjutnya</button>
                    <button id="restartBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded hidden" onclick="startQuiz()">🔄 Coba Lagi</button>
                </div>
                <p id="quizResult" class="font-bold mt-4 text-center text-lg text-gray-700"></p>
            </div>
        </div>

        <script>
            const questions = [
                {
                    text: "Apa yang sebaiknya dilakukan saat AQI mencapai 180?",
                    options: [
                        { text: "Pergi berolahraga di luar", correct: false },
                        { text: "Menyalakan AC dan membuka jendela", correct: false },
                        { text: "Menghindari aktivitas luar ruangan dan menutup ventilasi", correct: true }
                    ]
                },
                {
                    text: "Apa dampak jangka panjang dari paparan polusi udara?",
                    options: [
                        { text: "Meningkatkan stamina tubuh", correct: false },
                        { text: "Meningkatkan risiko ISPA dan penyakit paru kronis", correct: true },
                        { text: "Meningkatkan sistem kekebalan", correct: false }
                    ]
                },
                {
                    text: "Siapa kelompok paling rentan terhadap polusi udara?",
                    options: [
                        { text: "Remaja dan dewasa sehat", correct: false },
                        { text: "Anak-anak, lansia, dan penderita penyakit pernapasan", correct: true },
                        { text: "Atlet profesional", correct: false }
                    ]
                },
                {
                    text: "Apa itu AQI (Air Quality Index)?",
                    options: [
                        { text: "Skor kualitas makanan", correct: false },
                        { text: "Skor untuk menentukan polusi udara", correct: true },
                        { text: "Skor cuaca dan iklim", correct: false }
                    ]
                },
                {
                    text: "Apa perlindungan terbaik saat AQI menunjukkan angka berbahaya (>150)?",
                    options: [
                        { text: "Gunakan masker, tutup ventilasi, dan batasi aktivitas luar", correct: true },
                        { text: "Pergi ke pantai", correct: false },
                        { text: "Tidur di luar ruangan", correct: false }
                    ]
                }
            ];

            let currentQuestionIndex = 0;
            let score = 0;

            function startQuiz() {
                currentQuestionIndex = 0;
                score = 0;
                document.getElementById('quizResult').innerText = '';
                document.getElementById('restartBtn').classList.add('hidden');
                document.getElementById('nextBtn').classList.add('hidden');
                loadQuestion();
            }

            function loadQuestion() {
                const q = questions[currentQuestionIndex];
                document.getElementById('questionText').innerText = `🧠 ${q.text}`;
                const optionsContainer = document.getElementById('answerOptions');
                optionsContainer.innerHTML = '';

                q.options.forEach((option) => {
                    const btn = document.createElement('button');
                    btn.className = 'bg-blue-100 hover:bg-blue-200 px-3 py-1 rounded w-full text-left text-black';
                    btn.innerText = option.text;
                    btn.onclick = () => selectAnswer(option.correct);
                    optionsContainer.appendChild(btn);
                });
            }

            function selectAnswer(isCorrect) {
                const feedback = document.getElementById('quizResult');
                if (isCorrect) {
                    score++;
                    feedback.innerText = "✅ Jawaban benar!";
                    feedback.className = "text-green-600 font-bold mt-4 text-center";
                } else {
                    feedback.innerText = "❌ Kurang tepat. Yuk, pelajari lagi agar makin paham.";
                    feedback.className = "text-red-600 font-bold mt-4 text-center";
                }

                // Disable all options
                const buttons = document.querySelectorAll('#answerOptions button');
                buttons.forEach(btn => btn.disabled = true);

                // Tampilkan tombol Next jika masih ada pertanyaan
                if (currentQuestionIndex < questions.length - 1) {
                    document.getElementById('nextBtn').classList.remove('hidden');
                } else {
                    setTimeout(showFinalResult, 1000);
                }
            }

            document.getElementById('nextBtn').addEventListener('click', () => {
                currentQuestionIndex++;
                document.getElementById('nextBtn').classList.add('hidden');
                document.getElementById('quizResult').innerText = '';
                loadQuestion();
            });

            function showFinalResult() {
                const result = document.getElementById('quizResult');
                const totalScore = (score / questions.length) * 100;
                let message = "";

                if (totalScore === 100) {
                    message = "🌟 Hebat! Kamu menjawab semuanya dengan benar. Pengetahuanmu sangat baik!";
                } else if (totalScore >= 80) {
                    message = "👍 Sangat bagus! Hanya sedikit lagi untuk sempurna.";
                } else if (totalScore >= 60) {
                    message = "😊 Cukup baik! Masih ada ruang untuk belajar lebih dalam.";
                } else {
                    message = "💡 Yuk pelajari kembali agar lebih paham tentang polusi dan dampaknya.";
                }

                result.innerText = `🎯 Nilai Akhir: ${totalScore} / 100\n${message}`;
                result.className = "text-blue-800 font-bold mt-6 text-center whitespace-pre-line";

                document.getElementById('restartBtn').classList.remove('hidden');
            }

            // Mulai kuis pertama kali
            startQuiz();
        </script>
</x-app-layout>
