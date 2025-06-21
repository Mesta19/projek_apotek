#!/bin/bash
# === Instalasi Otomatis Projek Apotek (Linux/Mac) ===

set -e

# 1. Copy file env ke .env jika belum ada
if [ ! -f .env ]; then
    cp env .env || { 
        echo "[ERROR] Gagal menyalin file env ke .env.";
        echo "Solusi: Pastikan file 'env' ada di folder ini dan tidak sedang digunakan aplikasi lain.";
        exit 1;
    }
    echo "File .env berhasil dibuat dari env"
else
    echo "File .env sudah ada, dilewati"
fi

# 1a. Membuat database MySQL jika belum ada
if ! php create_db.php; then
    echo "[ERROR] Gagal membuat database MySQL."
    echo "Solusi: Pastikan konfigurasi database di .env benar dan MySQL berjalan."
    exit 1
fi

# 1b. Install composer dependencies
if ! command -v composer >/dev/null 2>&1; then
    echo "Composer tidak ditemukan! Silakan install Composer terlebih dahulu: https://getcomposer.org/download/"
    exit 1
else
    echo "Menjalankan composer install..."
    if ! composer install; then
        echo "[ERROR] Composer install gagal."
        echo "Solusi: Pastikan koneksi internet stabil dan composer sudah terinstall dengan benar."
        exit 1
    fi
fi

# 2. Migrasi database
if ! php spark migrate; then
    echo "[ERROR] Migrasi database gagal."
    echo "Solusi: Pastikan konfigurasi database di .env sudah benar dan database server aktif."
    exit 1
fi

# 3. Jalankan seeder database
if ! php spark db:seed DatabaseSeeder; then
    echo "[ERROR] Seeder database gagal dijalankan."
    echo "Solusi: Pastikan konfigurasi database benar dan seeder tersedia."
    exit 1
fi

echo
echo "Instalasi selesai! Website siap dijalankan."
echo "Jalankan: php spark serve"
echo "Buka http://localhost:8080 di browser"
