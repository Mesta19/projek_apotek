<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <?php if (session()->get('level') === 'Developer') : ?>
        <h2 class="mb-4">Halaman Khusus Developer</h2>
    <?php else : ?>
        <h2 class="mb-4">Selamat Datang, <?= $user['nama_lengkap']; ?></h2>
    <?php endif; ?>

    <div class="row gx-4 gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 offset-lg-1">
            <img class="img-fluid rounded shadow-sm" src="<?= base_url('uploads/gambar obat.png'); ?>" alt="Gambar Apotek" />
        </div>
        <div class="col-lg-5">
            <h1 class="font-weight-light">Selamat Datang di ApotekKu</h1>
            <p class="lead">Solusi kesehatan terpercaya Anda. Temukan berbagai obat, produk kesehatan, dan informasi penting.</p>
            <p>Kami berkomitmen untuk menyediakan akses mudah ke obat-obatan berkualitas dan layanan pelanggan yang prima.</p>
            <a class="btn btn-primary btn-lg" href="<?= base_url('obat'); ?>">Lihat Daftar Obat</a>
        </div>
    </div>

    <div class="row gx-4 gx-lg-5">
        <div class="col-md-6 mb-5">
            <div class="card h-100 shadow-sm rounded-3 border-light">
                <div class="card-body">
                    <h2 class="card-title fw-semibold"><i class="bi bi-capsule me-2 text-primary"></i> Obat Terbaru</h2>
                    <p class="card-text text-muted">Jangan lewatkan penawaran dan informasi mengenai obat-obatan terbaru yang tersedia di ApotekKu.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0"><a class="btn btn-outline-primary btn-sm" href="<?= base_url('obat'); ?>">Selengkapnya</a></div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card h-100 shadow-sm rounded-3 border-light">
                <div class="card-body">
                    <h2 class="card-title fw-semibold"><i class="bi bi-list-stars me-2 text-success"></i> Kategori Obat</h2>
                    <p class="card-text text-muted">Cari obat berdasarkan kategori seperti antibiotik, pereda nyeri, vitamin, dan lainnya.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0"><a class="btn btn-outline-success btn-sm" href="<?= base_url('kategori'); ?>">Lihat Kategori</a></div>
            </div>
        </div>
    </div>

    <div class="row gx-4 gx-lg-5">
        <?php if (session()->get('level') !== 'Guest') : ?>
            <div class="col-md-6 mb-5">
                <div class="card h-100 shadow-sm rounded-3 border-light">
                    <div class="card-body">
                        <h2 class="card-title fw-semibold"><i class="bi bi-file-earmark-bar-graph-fill me-2 text-info"></i> Laporan Penjualan</h2>
                        <p class="card-text text-muted">Pantau dan analisis laporan pendapatan apotek untuk pengambilan keputusan yang lebih baik.</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0"><a class="btn btn-outline-success btn-sm" href="<?= base_url('laporan/pendapatan'); ?>">Lihat Laporan</a></div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="container" style="margin-bottom: 70px;">
        <p class="text-center text-muted small">ApotekKu - Mitra Kesehatan Anda.</p>
    </div>
</div>


<?= $this->endSection(); ?>