@echo off
REM === Instalasi Otomatis Projek Apotek (Windows) ===

REM 1. Copy file env ke .env jika belum ada
IF NOT EXIST .env (
    copy env .env
    IF %ERRORLEVEL% NEQ 0 (
        echo [ERROR] Gagal menyalin file env ke .env.
        echo Solusi: Pastikan file 'env' ada di folder ini dan tidak sedang digunakan aplikasi lain.
        pause
        exit /b 1
    )
    echo File .env berhasil dibuat dari env
) ELSE (
    echo File .env sudah ada, dilewati
)

REM 1a. Membuat database MySQL jika belum ada
call php create_db.php
IF %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Gagal membuat database MySQL.
    echo Solusi: Pastikan konfigurasi database di .env benar dan MySQL berjalan.
    pause
    exit /b 1
)

REM 1b. Install composer dependencies
where composer >nul 2>nul
IF %ERRORLEVEL% NEQ 0 (
    echo Composer tidak ditemukan! Silakan install Composer terlebih dahulu: https://getcomposer.org/download/
    pause
    exit /b 1
) ELSE (
    echo Menjalankan composer install...
    call composer install
    IF %ERRORLEVEL% NEQ 0 (
        echo [ERROR] Composer install gagal.
        echo Solusi: Pastikan koneksi internet stabil dan composer sudah terinstall dengan benar.
        pause
        exit /b 1
    )
)

REM 2. Migrasi database
call php spark migrate
IF %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Migrasi database gagal.
    echo Solusi: Pastikan konfigurasi database di .env sudah benar dan database server aktif.
    pause
    exit /b 1
)

REM 3. Jalankan seeder database
call php spark db:seed DatabaseSeeder
IF %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Seeder database gagal dijalankan.
    echo Solusi: Pastikan konfigurasi database benar dan seeder tersedia.
    pause
    exit /b 1
)

echo.
echo Instalasi selesai! Website siap dijalankan.
echo Jalankan: php spark serve
echo Buka http://localhost:8080 di browser
pause
