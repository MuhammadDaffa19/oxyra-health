<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">🩺 Cek Risiko ISPA</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-10 bg-white shadow-xl rounded-2xl text-gray-800">
        <div class="mb-10 text-center">
            <h3 class="text-3xl font-extrabold text-indigo-700 mb-3">📋 Cek Risiko ISPA Anda Hari Ini</h3>
            <p class="text-gray-600 text-lg">Jawab pertanyaan berikut untuk mengetahui potensi risiko Infeksi Saluran Pernapasan Akut (ISPA).</p>
        </div>

        <form id="ispaForm" class="space-y-8 text-gray-800">
            @php
                $questions = [
                    "Apakah Anda sedang mengalami batuk atau pilek?",
                    "Apakah Anda merasa sesak napas atau napas pendek?",
                    "Apakah Anda tinggal di daerah dengan polusi udara tinggi?",
                    "Apakah Anda memiliki riwayat asma atau ISPA sebelumnya?",
                    "Apakah Anda sering berada di luar ruangan tanpa masker?",
                    "Apakah ada anggota keluarga yang sedang sakit saluran pernapasan?",
                    "Apakah Anda mengalami demam ringan hari ini?"
                ];
            @endphp

            @foreach ($questions as $i => $q)
            <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-md shadow-sm" id="question-box-{{ $i + 1 }}">
                <label class="block text-lg font-semibold mb-2">{{ $i + 1 }}. {{ $q }}</label>
                <div class="flex gap-6 pl-2">
                    <label><input type="radio" name="q{{ $i + 1 }}" value="yes" class="mr-2 text-indigo-600">Ya</label>
                    <label><input type="radio" name="q{{ $i + 1 }}" value="no" class="mr-2 text-indigo-600">Tidak</label>
                </div>
                <p class="text-red-600 text-sm mt-2 hidden" id="error-q{{ $i + 1 }}">Pertanyaan harus diisi!</p>
            </div>
            @endforeach

            <div class="text-center mt-10">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-full text-lg transition-all shadow-md hover:scale-105">
                    ✅ Lihat Hasil Evaluasi
                </button>
            </div>
        </form>

        {{-- Hasil Evaluasi --}}
        <div id="resultBox" class="hidden mt-12 p-6 rounded-xl shadow-md bg-gradient-to-br from-white to-indigo-50 border border-indigo-300 text-center">
            <h4 class="text-xl font-bold text-indigo-800 mb-2">📊 Hasil Evaluasi Risiko ISPA Anda</h4>
            <p id="ispaResultText" class="text-lg text-gray-700"></p>

            <button id="resetBtn" class="mt-6 bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-full text-sm font-semibold shadow transition hover:scale-105">
                🔁 Ulangi Jawaban
            </button>
        </div>
    </div>

    <script>
        const form = document.getElementById("ispaForm");
        const resultBox = document.getElementById("resultBox");
        const resultText = document.getElementById("ispaResultText");
        const resetBtn = document.getElementById("resetBtn");

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            let score = 0;
            let firstUnanswered = null;
            let isValid = true;

            for (let i = 1; i <= 7; i++) {
                const radios = document.querySelectorAll(`input[name="q${i}"]`);
                const isAnswered = Array.from(radios).some(r => r.checked);
                const errorMsg = document.getElementById(`error-q${i}`);

                if (!isAnswered) {
                    isValid = false;
                    errorMsg.classList.remove("hidden");
                    if (!firstUnanswered) {
                        firstUnanswered = document.getElementById(`question-box-${i}`);
                    }
                } else {
                    errorMsg.classList.add("hidden");
                    const selected = document.querySelector(`input[name="q${i}"]:checked`);
                    if (selected.value === "yes") score++;
                }
            }

            if (!isValid) {
                firstUnanswered.scrollIntoView({ behavior: "smooth", block: "center" });
                return;
            }

            let result = "";
            if (score >= 5) {
                result = "⚠️ Risiko ISPA Anda <span class='text-red-600 font-bold'>tinggi</span>. Disarankan konsultasi dengan tenaga medis.";
            } else if (score >= 3) {
                result = "🟡 Risiko <span class='text-yellow-600 font-bold'>sedang</span>. Jaga kondisi tubuh dan hindari paparan udara buruk.";
            } else {
                result = "✅ Risiko <span class='text-green-600 font-bold'>rendah</span>. Terus jaga kesehatan dan lingkungan Anda.";
            }

            resultText.innerHTML = result;
            resultBox.classList.remove("hidden");
            resultBox.scrollIntoView({ behavior: "smooth" });
        });

        resetBtn.addEventListener("click", function () {
            form.reset();
            resultBox.classList.add("hidden");

            for (let i = 1; i <= 7; i++) {
                document.getElementById(`error-q${i}`).classList.add("hidden");
            }

            window.scrollTo({ top: form.offsetTop, behavior: 'smooth' });
        });
    </script>
</x-app-layout>
