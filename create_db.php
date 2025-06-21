<?php
// create_db.php
// Membuat database MySQL jika belum ada, berdasarkan konfigurasi .env

function getEnvVar($key, $default = null) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, $key . '=') === 0) {
            $val = trim(substr($line, strlen($key) + 1));
            if (strlen($val) && $val[0] === '"' && $val[strlen($val)-1] === '"') {
                $val = substr($val, 1, -1);
            }
            return $val;
        }
    }
    return $default;
}

$dbHost = getEnvVar('database.default.hostname', 'localhost');
$dbUser = getEnvVar('database.default.username', 'root');
$dbPass = getEnvVar('database.default.password', '');
$dbName = getEnvVar('database.default.database', 'db_apotek');

$conn = new mysqli($dbHost, $dbUser, $dbPass);
if ($conn->connect_error) {
    echo "[ERROR] Gagal koneksi ke MySQL: " . $conn->connect_error . PHP_EOL;
    exit(1);
}

$sql = "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
if ($conn->query($sql) === TRUE) {
    echo "Database '{$dbName}' siap digunakan." . PHP_EOL;
} else {
    echo "[ERROR] Gagal membuat database: " . $conn->error . PHP_EOL;
    exit(1);
}
$conn->close();
