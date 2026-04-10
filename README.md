# 🏢 Sistem Informasi Administrasi & Keuangan (ERP Mini)

Aplikasi ERP Mini berbasis web yang dirancang khusus untuk mengelola operasional perdagangan, stok barang, transaksi kas, dan piutang pelanggan. Dibangun menggunakan Laravel 11 dan Filament v3.

## ✨ Fitur Utama
* **Manajemen Master Data:** Kelola data barang (stok dasar) dan multi-rekening bank.
* **Manajemen Stok Real-time:** Pencatatan otomatis aspal masuk dan keluar.
* **Buku Kas Umum (BKU):** Pencatatan sirkulasi uang masuk (Debet) dan keluar (Kredit) dengan kalkulasi saldo berjalan otomatis.
* **Manajemen Piutang:** Pelacakan sisa hutang pelanggan, bunga, dan riwayat cicilan.
* **Kuitansi Digital:** Cetak kuitansi penerimaan dan pengeluaran secara otomatis dalam format PDF.
* **Laporan Neraca:** Ringkasan total Aktiva (Kas, Bank, Piutang, Persediaan) dan Pasiva secara *real-time*.

## 🛠️ Tech Stack
* **Backend:** Laravel 11 (PHP 8.2+)
* **Admin Panel:** Filament PHP v3
* **Database:** MySQL / PostgreSQL
* **PDF Generator:** barryvdh/laravel-dompdf

---

## 🚀 Panduan Instalasi (Cara Menjalankan Project)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi ini di komputer/server Anda (Local Development).

### 1. Kebutuhan Sistem
Pastikan komputer Anda sudah terinstal:
* [PHP](https://www.php.net/) (Minimal versi 8.2) beserta ekstensi `zip`, `dom`, `curl`, dan `mbstring`.
* [Composer](https://getcomposer.org/)
* [MySQL](https://www.mysql.com/) atau MariaDB (Bisa menggunakan XAMPP/Laragon)
* [Git](https://git-scm.com/)

### 2. Clone Repository
Buka terminal dan *clone repository* ini ke folder lokal Anda:
```bash
git clone [https://github.com/UsernameAnda/erp-bjt.git](https://github.com/UsernameAnda/erp-bjt.git)
cd erp-bjt