# 🌿 Oxyra Health – SDGs 3: Good Health and Well-Being

Oxyra Health adalah aplikasi web berbasis Laravel 10 yang dirancang untuk membantu masyarakat memantau kualitas udara secara real-time dan mendapatkan edukasi kesehatan untuk mencegah penyakit seperti ISPA (Infeksi Saluran Pernapasan Akut), sebagai kontribusi terhadap **SDGs 3** (*Good Health and Well-Being*).

<p align="center">
  <img src="https://raw.githubusercontent.com/MuhammadDaffa19/oxyra-health/main/public/images/OXYRA%20HEALTH.png" width="300" alt="Oxyra Health Logo">
</p>

---

## 🔧 Fitur Utama

- 💨 **Dashboard Kualitas Udara Real-Time**  
  Menampilkan nilai AQI terkini dari berbagai kota.

- ⭐ **Kota Favorit**  
  Simpan kota favorit agar pengguna bisa memantau kualitas udara tanpa perlu mencari ulang.

- 📘 **Edukasi Polusi & ISPA**  
  Artikel dan informasi penting tentang polusi dan dampaknya terhadap kesehatan.

- 🩺 **Cek Risiko ISPA**  
  Form interaktif untuk menilai kemungkinan terkena Infeksi Saluran Pernapasan Akut.

- 💡 **Tips Kesehatan**  
  Rekomendasi praktis untuk menjaga kesehatan di tengah kondisi udara buruk.

- 📍 **Lokasi Saya**  
  Menampilkan kualitas udara berdasarkan lokasi pengguna saat ini.

- 💨 **Kalkulator Napas Sehat**  
  Simulasi sederhana yang menunjukkan estimasi napas sehat berdasarkan data AQI.

- 👤 **Autentikasi Pengguna**  
  Fitur login, register, dan manajemen profil.

---

## 🚀 Instalasi Proyek

### 1. Clone Repository

```bash
git clone https://github.com/MuhammadDaffa19/oxyra-health.git
cd oxyra-health
````

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment File

```bash
cp .env.example .env
```

Lalu isi `.env` seperti berikut:

```env
APP_NAME="Oxyra Health"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=oxyra_db
DB_USERNAME=root
DB_PASSWORD=

WAQI_API_TOKEN=isi_dengan_token_waqi_kamu
```

> 🎯 Dapatkan token API dari [https://waqi.info](https://waqi.info)

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi

```bash
php artisan migrate
```

### 6. Jalankan Server Laravel

```bash
php artisan serve
```

### 7. Jalankan Dev Server untuk Assets

```bash
npm run dev
```

---

## 📌 Catatan

* Folder vendor/, .env, dan node_modules/ diabaikan dengan .gitignore
* Untuk akses semua fitur, pastikan koneksi ke database dan API sudah aktif

---

## 📸 Galeri Dokumentasi Aplikasi Oxyra Health

Berikut adalah tampilan-tampilan dari aplikasi Oxyra Health berbasis Laravel 10 yang mendukung SDGs 3 (*Good Health and Well-Being*). Setiap fitur dirancang untuk memantau kualitas udara dan menjaga kesehatan masyarakat dari ancaman polusi dan ISPA.

---

### 🏠 Halaman Utama Sebelum Login

<img width="100%" alt="tampilan sebelum login" src="https://github.com/user-attachments/assets/e4abc65d-e679-45fd-a8e5-5da0319f3b2b" />

Tampilan awal website yang menyambut pengguna. Menampilkan deskripsi singkat dan akses ke login atau register.

---

### 🔐 Halaman Login

<img width="100%" alt="halaman login" src="https://github.com/user-attachments/assets/f4a700ba-22ac-42cb-9049-3a1682890eeb" />

Form untuk pengguna yang sudah memiliki akun agar bisa login dan mengakses fitur-fitur utama.

---

### 📝 Halaman Register

<img width="100%" alt="halaman register" src="https://github.com/user-attachments/assets/e0f8f86c-835d-42f0-897a-be500b7dc7c7" />

Form registrasi untuk pengguna baru yang ingin mendaftar di Oxyra Health.

---

### 🧭 Dashboard Setelah Login

<img width="100%" alt="tampilan setelah login" src="https://github.com/user-attachments/assets/bfed2278-d56f-4672-8933-4b87ebf6f21b" />

Dashboard utama yang menampilkan status kualitas udara terkini berdasarkan kota pilihan atau lokasi pengguna.

---

### ⭐ Kota Favorit

<img width="100%" alt="kota favorit" src="https://github.com/user-attachments/assets/b1c254b7-843d-4689-8b6b-4e3a10d351d0" />

Pengguna dapat menyimpan kota-kota favorit untuk memantau AQI secara berkala tanpa perlu mencari ulang.

---

### 💡 Tips Kesehatan Berdasarkan AQI

<img width="100%" alt="Tips Kesehatan Berdasarkan AQI" src="https://github.com/user-attachments/assets/89a31fc4-2039-462f-9505-fbc91bd95f59" />
<img width="100%" alt="Tips Kesehatan Berdasarkan AQI 2" src="https://github.com/user-attachments/assets/25af76e3-8843-4f66-8ceb-1f9ccce16480" />

Tips kesehatan harian yang disesuaikan dengan kualitas udara saat ini. Semakin buruk AQI, semakin penting menjaga kesehatan pernapasan.

---

### 📘 Edukasi Polusi dan ISPA

<img width="100%" alt="Edukasi Polusi & ISPA" src="https://github.com/user-attachments/assets/564c23dc-0405-48f8-a7a6-689cb3ea4ad1" />
<img width="100%" alt="Edukasi Polusi & ISPA 2" src="https://github.com/user-attachments/assets/ec4858fc-7a4e-4b87-9b51-c9214afd9403" />
<img width="100%" alt="Edukasi Polusi & ISPA 3" src="https://github.com/user-attachments/assets/eb534a66-2768-4245-bf4a-0e8d93fcaf12" />

Menampilkan informasi tentang dampak polusi udara, gejala ISPA, serta langkah-langkah pencegahan berbasis literasi kesehatan. Serta ada mini game QUIZ sederhana untuk Tes Pengetahuanmu tentang Polusi & Kesehatan!

---

### 📍 Lokasi Saya

<img width="100%" alt="Lokasi Saya" src="https://github.com/user-attachments/assets/e9efd1a2-b36a-48ad-aeae-15fb2c45bac2" />
<img width="100%" alt="Lokasi Saya 2" src="https://github.com/user-attachments/assets/4462aa54-8590-418e-b9da-b1cf4cee5bba" />
<img width="100%" alt="Lokasi Saya 3" src="https://github.com/user-attachments/assets/3e4d2499-183c-4272-8f8b-053e8be2c382" />

Fitur ini menampilkan kualitas udara berdasarkan lokasi pengguna saat ini, didukung API geolokasi dan WAQI.

---

### 🩺 Cek Risiko ISPA

<img width="100%" alt="Cek Risiko ISPA" src="https://github.com/user-attachments/assets/f10ae184-6b91-4bc5-b464-c1519b4a33c4" />
<img width="100%" alt="Cek Risiko ISPA 2" src="https://github.com/user-attachments/assets/1b997b86-9b2c-4557-91b7-d53110c73e02" />
<img width="100%" alt="Cek Risiko ISPA 3" src="https://github.com/user-attachments/assets/cd67658e-363a-4fab-88e3-fc896b0f0cc2" />

Form sederhana untuk mengetahui tingkat risiko ISPA berdasarkan gejala yang dirasakan dan status lingkungan.

---

### 💨 Kalkulator Napas Sehat

<img width="100%" alt="Kalkulator Napas Sehat" src="https://github.com/user-attachments/assets/4d9d048f-7096-4d2a-b92b-8ff376d65dc6" />
<img width="100%" alt="Kalkulator Napas Sehat 2" src="https://github.com/user-attachments/assets/eca3d3f5-fa7b-4804-bd74-ac815f92a757" />

Kalkulator untuk memperkirakan durasi napas sehat harian yang masih aman berdasarkan paparan udara saat ini.

---

> Semua fitur di atas dibuat untuk membantu masyarakat dalam meningkatkan kesadaran terhadap pentingnya menjaga kesehatan pernapasan sebagai kontribusi terhadap **Sustainable Development Goals (SDGs) nomor 3**.

---

