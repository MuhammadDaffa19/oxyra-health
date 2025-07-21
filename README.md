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
