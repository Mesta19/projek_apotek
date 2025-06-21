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

## Langkah Instalasi & Setup Awal

### 1. Install & Siapkan XAMPP

- Download dan install XAMPP sesuai OS Anda.
- Jalankan XAMPP Control Panel, aktifkan **Apache** dan **MySQL**.
- Buka phpMyAdmin (`http://localhost/phpmyadmin`), buat database baru, misal: `db_apotek`.

### 2. Clone Project & Instalasi Otomatis

#### a. Windows

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
   - Migrasi database
   - Menjalankan seeder database
   - Website siap digunakan
4. Jalankan website:
   ```bash
   php spark serve
   # Buka http://localhost:8080 di browser
   ```

#### b. Linux & Mac

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
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```
   Perintah di atas akan:
   - Membuat file .env dari env jika belum ada
   - Migrasi database
   - Menjalankan seeder database
   - Website siap digunakan
4. Jalankan website:
   ```bash
   php spark serve
   # Buka http://localhost:8080 di browser
   ```

### 3. (Opsional) Cara Manual

1. **Download/Clone Project**
   - Tempatkan folder project ini di `htdocs` (misal: `C:/xampp/htdocs/projek_apotek`)
   - Jika dari GitHub:
     ```bash
     git clone https://github.com/Mesta19/projek_apotek.git
     cd projek_apotek
     ```
2. **Install Dependency Composer**
   ```bash
   composer install
   ```
3. **Copy & Edit File Environment**
   ```bash
   cp env .env
   # Edit file .env jika ingin override konfigurasi database
   ```
4. **Konfigurasi Database**
   - Buat database baru di phpMyAdmin/MySQL, misal: `db_apotek`
   - Edit file `.env` atau `app/Config/Database.php` pada bagian berikut:
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
