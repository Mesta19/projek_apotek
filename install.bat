@echo off
REM === Instalasi Otomatis Projek Apotek (Windows) ===

REM 1. Copy file env ke .env jika belum ada
IF NOT EXIST .env (
    copy env .env
    echo File .env berhasil dibuat dari env
) ELSE (
    echo File .env sudah ada, dilewati
)

REM 1b. Install composer dependencies
where composer >nul 2>nul
IF %ERRORLEVEL% NEQ 0 (
    echo Composer tidak ditemukan! Silakan install Composer terlebih dahulu: https://getcomposer.org/download/
    pause
    exit /b 1
) ELSE (
    echo Menjalankan composer install...
    composer install
)

REM 2. Migrasi database
php spark migrate

REM 3. Jalankan seeder database
php spark db:seed DatabaseSeeder

echo.
echo Instalasi selesai! Website siap dijalankan.
echo Jalankan: php spark serve
echo Buka http://localhost:8080 di browser
pause
