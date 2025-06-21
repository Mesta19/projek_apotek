# Projek Website Kasir Apotek (CodeIgniter 4)

Website ini merupakan aplikasi kasir untuk apotek. Fitur utama:

- Manajemen data obat
- Manajemen kategori obat
- Manajemen user
- Transaksi penjualan layaknya kasir apotek
- Cetak barcode, upload gambar obat, dan fitur pendukung lain

---

## Requirement

- XAMPP (https://www.apachefriends.org/) — WAJIB, untuk Apache & MySQL
- PHP 8.1 atau lebih baru (sudah termasuk di XAMPP terbaru)
- Composer (https://getcomposer.org/)
- Git (https://git-scm.com/)

> **Disarankan:** Selalu gunakan XAMPP, letakkan project di folder `htdocs` (misal: `C:/xampp/htdocs/`)

## Instalasi Otomatis (Disarankan)

### Windows

1. Buka **Command Prompt** di folder `C:/xampp/htdocs/`.
2. Clone project:
   ```bash
   git clone https://github.com/Mesta19/projek_apotek.git
   cd projek_apotek
   ```
3. Jalankan script instalasi otomatis:
   ```bat
   install.bat
   ```
   Script ini akan:
   - Membuat file .env dari env jika belum ada
   - Membuat database MySQL otomatis sesuai konfigurasi
   - Install dependency composer
   - Migrasi database
   - Menjalankan seeder database
   - Website siap digunakan
4. Jalankan website:
   ```bash
   php spark serve
   # Buka http://localhost:8080 di browser
   ```

### Linux & Mac

1. Buka terminal di folder `htdocs` XAMPP Anda.
2. Clone project:
   ```bash
   git clone https://github.com/Mesta19/projek_apotek.git
   cd projek_apotek
   ```
3. Jalankan perintah instalasi otomatis:
   ```bash
   composer install
   [ -f .env ] || cp env .env
   php create_db.php
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```
   Perintah di atas akan:
   - Membuat file .env dari env jika belum ada
   - Membuat database MySQL otomatis sesuai konfigurasi
   - Install dependency composer
   - Migrasi database
   - Menjalankan seeder database
   - Website siap digunakan
4. Jalankan website:
   ```bash
   php spark serve
   # Buka http://localhost:8080 di browser
   ```

> **Catatan:** Semua proses setup (termasuk pembuatan database) dilakukan otomatis oleh script instalasi di atas. Tidak perlu membuat database manual di phpMyAdmin.

---

## Akun Default Login

- Username: `developer`
- Password: `developer`
- Level: `Developer`

## Catatan Penting

- Folder upload/gambar/barcode sudah disiapkan di `public/assets/`.
- Jika ingin reset data, jalankan ulang seeder: `php spark db:seed DatabaseSeeder`
- Jika ada error ekstensi PHP, aktifkan melalui `php.ini` (XAMPP: menu PHP > php.ini > cari dan hilangkan tanda `;` pada extension yang dibutuhkan).

---

Panduan ini hanya untuk instalasi dan setup awal. Untuk pengembangan lebih lanjut, silakan sesuaikan sesuai kebutuhan Anda.
