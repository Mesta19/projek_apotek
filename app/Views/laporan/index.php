<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4"><?= esc($title) ?></h1>
    <p class="lead mb-5">
        Selamat datang di halaman laporan. Pilih menu laporan berikut untuk melihat data penjualan dan pendapatan toko secara lengkap.
    </p>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Laporan Penjualan</h3>
                    <p class="card-text">Tampilkan semua riwayat transaksi penjualan lengkap dengan detail obat, jumlah, harga, dan total pembayaran.</p>
                    <a href="<?= base_url('laporan/penjualan') ?>" class="btn btn-primary">Lihat Laporan Penjualan</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Laporan Pendapatan</h3>
                    <p class="card-text">Tampilkan total pendapatan toko berdasarkan transaksi yang sudah dilakukan, tanpa filter waktu maupun dengan filter tanggal.</p>
                    <a href="<?= base_url('laporan/pendapatan') ?>" class="btn btn-success">Lihat Laporan Pendapatan</a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="mt-4">
        <h5>Petunjuk Penggunaan</h5>
        <ul>
            <li>Gunakan <strong>Laporan Penjualan</strong> untuk melihat detail transaksi per obat.</li>
            <li>Gunakan <strong>Laporan Pendapatan</strong> untuk mengetahui total pemasukan toko.</li>
            <li>Filter tanggal tersedia di masing-masing laporan untuk membatasi periode data.</li>
            <li>Pastikan data transaksi sudah tercatat dengan benar agar laporan akurat.</li>
        </ul>
    </div>
</div>

<?= $this->endSection() ?>
