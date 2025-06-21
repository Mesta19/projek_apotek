# Projek Website Kasir Apotek (CodeIgniter 4)

Website ini merupakan aplikasi kasir untuk apotek. Fitur utama:

- Manajemen data obat
- Manajemen kategori obat
- Manajemen user
- Transaksi penjualan layaknya kasir apotek
- Cetak barcode, upload gambar obat, dan fitur pendukung lain

---

## Requirement

- PHP 8.1 atau lebih baru
- Ekstensi PHP yang wajib aktif:
  - intl
  - mbstring
  - curl
  - gd
  - json (default aktif)
  - mysqlnd (untuk MySQL/MariaDB)
- Composer (https://getcomposer.org/)
- Web server (disarankan XAMPP, folder di `xampp/htdocs`)
- MySQL/MariaDB

## Langkah Instalasi

1. **Download/Clone Project**

   - Tempatkan folder project ini di `xampp/htdocs/` (misal: `xampp/htdocs/projek_apotek`)
   - Jika dari GitHub:
     ```bash
     git clone https://github.com/username/projek_apotek.git
     cd projek_apotek
     ```

2. **Install Dependency Composer**

   ```bash
   composer install
   ```

3. **Copy & Edit File Environment**

   ```bash
   cp env .env
   # Edit file .env, sesuaikan konfigurasi database Anda
   ```

4. **Konfigurasi Database**

   - Buat database baru di phpMyAdmin/MySQL, misal: `db_apotek`
   - Edit file `.env` pada bagian berikut:
     ```
     database.default.hostname = 127.0.0.1
     database.default.database = db_apotek
     database.default.username = root
     database.default.password =
     database.default.DBDriver = MySQLi
     ```

5. **Migrasi & Seeder Database**
   Jalankan perintah berikut di terminal/cmd dari folder project:

   ```bash
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```

   Ini akan membuat seluruh tabel dan mengisi data awal (user, kategori, obat, transaksi, dll).

6. **Menjalankan Website**
   ```bash
   php spark serve
   # Buka http://localhost:8080 di browser
   ```

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
