# SISTEM-INFORMASI-DONASI-LEMBAGA

Aplikasi Sistem Informasi Donasi Lembaga yang dibuat menggunakan Laravel sebagai tugas akhir.

---

## Tentang Proyek

Proyek ini bertujuan untuk memudahkan pengelolaan donasi pada lembaga tertentu.  
Fitur utama yang direncanakan dalam aplikasi ini:

- Manajemen donatur
- Pencatatan transaksi donasi
- Laporan pemasukan donasi
- Autentikasi untuk admin
- Sistem data arsip donasi

---

## Teknologi yang Digunakan
- Laravel (PHP Framework)
- MySQL Database
- HTML, CSS, JavaScript
- Bootstrap / Tailwind (opsional, sesuai proyek)

---

## Cara Menjalankan Proyek

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
