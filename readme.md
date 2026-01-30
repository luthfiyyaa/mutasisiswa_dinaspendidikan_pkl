# Sistem Informasi Mutasi Siswa


> Aplikasi Web untuk Pengelolaan Data Mutasi Siswa Dinas Pendidikan Kabupaten Trenggalek


[![Version](https://img.shields.io/badge/version-2.0-blue.svg)](https://github.com/luthfiyyaa/mutasisiswa_dinaspendidikan_pkl)


## 📋 Deskripsi


Sistem Informasi Mutasi Siswa adalah aplikasi berbasis web yang dirancang untuk mengelola data mutasi siswa baik masuk maupun keluar di lingkungan Dinas Pendidikan Kabupaten Trenggalek. Sistem versi 2.0 ini merupakan pengembangan dari versi sebelumnya dengan teknologi yang lebih modern dan tampilan yang lebih modern.


### Tujuan Pengembangan


- ✨ Memodernisasi teknologi dengan framework dan library terkini
- 🚀 Meningkatkan performa sistem dalam menangani data berskala besar
- 🎨 Menyediakan antarmuka yang lebih modern, responsif, dan intuitif
- 📊 Menyempurnakan fitur dashboard, laporan, dan generate surat
- 🔧 Memudahkan maintenance dan pengembangan di masa depan


## ✨ Fitur Utama


### 1. Dashboard & Visualisasi Data
- 📈 Tampilan total mutasi masuk dan keluar
- 📊 Statistik per bidang pendidikan
- 🗺️ Grafik distribusi mutasi per kecamatan
- 📉 Visualisasi data interaktif dan real-time


### 2. Manajemen Data Mutasi
- ➕ Tambah data mutasi siswa masuk dan keluar
- ✏️ Edit dan update data mutasi
- 🗑️ Hapus data mutasi
- 🔍 Pencarian dan filter data mutasi


### 3. Laporan & Dokumen
- 📄 Generate laporan dalam format Excel
- 🗓️ Filter laporan berdasarkan tanggal dan jenjang
- 📝 Generate surat rekomendasi mutasi dalam format pdf otomatis
- 💾 Download laporan dan surat


### 4. Manajemen Data Master
- 🏫 Kelola data sekolah
- 📍 Kelola data kecamatan
- 🎓 Kelola data jenjang pendidikan
- 👥 Kelola data user dan pejabat


### 5. Sistem Keamanan
- 🔐 Autentikasi login dengan enkripsi password
- 👮 Role-based access control
- 📝 Audit log untuk aktivitas penting


## 👥 Role Pengguna


| Role | Akses | Tingkat Keahlian |
|------|-------|------------------|
| **Administrator** | Full akses: kelola sistem, user, dan konfigurasi | Tinggi |
| **Operator USC** | CRUD data mutasi, cetak surat & laporan | Menengah |
| **Operator Bidang** | Lihat data mutasi bidang, cetak laporan | Rendah |


## 🛠️ Teknologi


### Frontend
- HTML5, CSS3, JavaScript
- Responsive Design
- Modern UI/UX Framework


### Backend
- PHP dan Framework Laravel dengan dukungan jangka panjang


### Database
- MySQL untuk penyimpanan data


### Library & Tools
- Excel Generator
- PDF Generator
- Chart/Visualization Library


## 📦 Instalasi


### Prasyarat
- Web Server
- Database Server
- PHP 8.x / Node.js (sesuai stack yang dipilih)
- Composer / npm


### Langkah Instalasi


1. Clone repository
```bash
git clone https://github.com/luthfiyyaa/mutasisiswa_dinaspendidikan_pkl
cd mutasi-siswa
```


2. Install dependencies
```bash
# Jika menggunakan Composer
composer install


# Jika menggunakan npm
npm install
```


3. Konfigurasi environment
```bash
cp .env.example .env
# Edit file .env sesuai konfigurasi
```


4. Setup database
```bash
# Jalankan migration
php artisan migrate
```


5. Generate application key
```bash
php artisan key:generate
```


6. Jalankan aplikasi
```bash
# Development
php artisan serve


# Production
# Setup web server (Apache/Nginx)
```


## 🚀 Penggunaan


### Login Pertama Kali
1. Akses aplikasi melalui browser: http://localhost:8000
2. Login menggunakan kredensial default administrator


### Menambah Data Mutasi
1. Login dengan username dan password yang diberikan
2. Pilih menu **Mutasi Masuk** atau **Mutasi Keluar**
3. Klik tombol **Tambah Data**
4. Isi form data mutasi siswa
5. Klik **Simpan**


### Generate Surat Rekomendasi
1. Pilih data mutasi dari daftar mutasi masuk atau keluar
2. Klik tombol berbentuk print, kemudian akan diarahkan menuju halaman Detail
3. Klik tombol **Cetak Surat Rekomendasi**
4. Surat akan otomatis tergenerate dan siap diunduh


### Generate Laporan Excel
1. Pilih menu **Laporan Mutasi Masuk** atau **Laporan Mutasi Keluar**
2. Pilih filter tanggal dan jenjang
3. Klik **Cetak Laporan**
4. File laporan akan terunduh otomatis


## 📊 Spesifikasi Performance


- ⚡ Dashboard loading: maksimal 3 detik
- 🔄 Form response: maksimal 2 detik
- 📈 Generate surat rekomendasi: maksimal 10 detik
- 📊 Cetak laporan Excel: maksimal 5 detik
- 💻 Table data loading: maksimal 10 detik


## 🔒 Keamanan


- Password di-hash menggunakan algoritma aman
- Komunikasi menggunakan HTTPS/TLS
- Session timeout setelah 30 menit tidak aktif
- Proteksi terhadap SQL Injection, XSS, dan CSRF


## 📱 Browser Support


- Google Chrome 90+
- Mozilla Firefox 88+
- Safari 14+
- Microsoft Edge 90+


## 👨‍💻 Tim Pengembang


**Mahasiswa:**
- Luthfiyya Ayu Noor Chandra - NIM. 235150600111025
- Rahma Aulia Priyono - NIM. 235150600111018
- Laela Luthfiana Rachman - NIM. 235150601111018


**Pembimbing:**
- Yussef Fanandri, A.Md. dan Ahmad Ihsan - Pranata Komputer Dinas Pendidikan Kabupaten Trenggalek


## 📞 Kontak


Untuk pertanyaan atau dukungan, silakan hubungi:
- Email: dinaspendidikan@trenggalekkab.go.id
- Website: https://dindik.trenggalekkab.go.id


## 🙏 Acknowledgments


- Dinas Pendidikan Kabupaten Trenggalek
- Unit Service Center
- Semua pihak yang telah berkontribusi dalam pengembangan sistem ini


---


**Versi:** 2.0  
**Tanggal Rilis:** 2 Februari 2026
**Status:** Active Development


© 2026 Dinas Pendidikan Kabupaten Trenggalek. All Rights Reserved.