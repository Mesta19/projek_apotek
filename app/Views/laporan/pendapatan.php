<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
Laporan Pendapatan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="mb-4 mt-4"><?= esc($title) ?></h1>

<?php if (session()->get('level') === 'Developer') : ?>
    <form id="hapusSemuaPendapatanForm" action="<?= base_url('laporan/hapusSemuaPendapatan') ?>" method="post" class="mb-4">
        <?= csrf_field() ?>
        <button type="button" class="btn btn-danger" id="btn-hapus-semua-pendapatan">Hapus Semua Catatan Pendapatan</button>
    </form>
<?php endif; ?>


<div class="card card-body mb-4">
    <h5>Filter Laporan</h5>

    <?php
    // Logika untuk menyiapkan tanggal dan status tombol aktif
    $today = date('Y-m-d');
    $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));
    $firstDayOfMonth = date('Y-m-01');

    // Cek status aktif untuk tombol preset
    $isTodayActive = ($tanggal_awal == $today && $tanggal_akhir == $today);
    $isWeeklyActive = ($tanggal_awal == $sevenDaysAgo && $tanggal_akhir == $today);
    $isMonthlyActive = ($tanggal_awal == $firstDayOfMonth && $tanggal_akhir == $today);
    $isCustomActive = !empty($tanggal_awal) && !($isTodayActive || $isWeeklyActive || $isMonthlyActive);
    ?>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="<?= base_url('laporan/pendapatan') ?>?tanggal_awal=<?= $today ?>&tanggal_akhir=<?= $today ?>" class="btn <?= $isTodayActive ? 'btn-primary' : 'btn-outline-primary' ?>">Hari Ini</a>
        <a href="<?= base_url('laporan/pendapatan') ?>?tanggal_awal=<?= $sevenDaysAgo ?>&tanggal_akhir=<?= $today ?>" class="btn <?= $isWeeklyActive ? 'btn-primary' : 'btn-outline-primary' ?>">Minggu Ini</a>
        <a href="<?= base_url('laporan/pendapatan') ?>?tanggal_awal=<?= $firstDayOfMonth ?>&tanggal_akhir=<?= $today ?>" class="btn <?= $isMonthlyActive ? 'btn-primary' : 'btn-outline-primary' ?>">Bulan Ini</a>

        <button class="btn <?= $isCustomActive ? 'btn-primary' : 'btn-outline-primary' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCustomDate" aria-expanded="<?= $isCustomActive ? 'true' : 'false' ?>" aria-controls="collapseCustomDate">
            Pilih Tanggal Sendiri
        </button>

        <?php if (!empty($tanggal_awal) || !empty($tanggal_akhir)) : ?>
            <a href="<?= base_url('laporan/pendapatan') ?>" class="btn btn-danger ms-auto">Reset Filter</a>
        <?php endif; ?>
    </div>

    <div class="collapse <?= $isCustomActive ? 'show' : '' ?>" id="collapseCustomDate">
        <form method="get" action="<?= base_url('laporan/pendapatan') ?>" class="row g-3 border-top pt-3">
            <div class="col-md-5">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" value="<?= esc($tanggal_awal) ?>">
            </div>
            <div class="col-md-5">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="<?= esc($tanggal_akhir) ?>">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="alert alert-success text-center py-4 h-100">
            <h4 class="mb-3">
                <?php if (!empty($tanggal_awal)): ?>
                    Pendapatan dari <?= date('d M Y', strtotime($tanggal_awal)) ?> s/d <?= date('d M Y', strtotime($tanggal_akhir)) ?>
                <?php else: ?>
                    Pendapatan Berdasarkan Filter
                <?php endif; ?>
            </h4>
            <h3 class="fw-bold">Rp <?= number_format($pendapatan['total_pendapatan'] ?? 0, 0, ',', '.') ?></h3>
            <small class="text-muted">
                <?php if (empty($tanggal_awal)): ?>
                    Silakan pilih filter di atas untuk melihat total pendapatan pada periode tertentu.
                <?php endif; ?>
            </small>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="alert alert-info text-center py-4 h-100">
            <h4 class="mb-3">Total Seluruh Pendapatan</h4>
            <h3 class="fw-bold">Rp <?= number_format($totalSeluruhPendapatan['total_pendapatan'] ?? 0, 0, ',', '.') ?></h3>
            <small class="text-muted">Akumulasi pendapatan dari semua transaksi yang tercatat.</small>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Rincian Obat Terjual</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)) : ?>
            <p class="text-muted">Menampilkan produk terjual dari tanggal <?= esc(date('d M Y', strtotime($tanggal_awal))) ?> s/d <?= esc(date('d M Y', strtotime($tanggal_akhir))) ?>.</p>
        <?php else : ?>
            <p class="text-muted">Filter tanggal untuk melihat rincian obat terjual pada periode tertentu.</p>
        <?php endif; ?>

        <?php if (!empty($stok_terjual)) : ?>
            <div class="row">
                <?php foreach ($stok_terjual as $item) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card h-100 text-center shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="card-title" style="font-size: 1rem;"><?= esc($item['nama_obat']) ?></h5>
                                <p class="card-text fs-4 fw-bold text-primary mb-0"><?= esc($item['total_terjual']) ?></p>
                                <small class="text-muted">Terjual</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($tanggal_awal)) : ?>
            <div class="alert alert-warning text-center">
                Tidak ada data obat yang terjual pada periode yang dipilih.
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnHapusSemuaPendapatan = document.getElementById('btn-hapus-semua-pendapatan');
        if (btnHapusSemuaPendapatan) {
            btnHapusSemuaPendapatan.addEventListener('click', function() {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Anda yakin ingin menghapus SEMUA catatan pendapatan DAN RIWAYAT TRANSAKSI? Tindakan ini akan menghapus seluruh data dari tabel detail transaksi dan transaksi, dan tidak dapat diurungkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus Semua!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('hapusSemuaPendapatanForm').submit();
                    }
                });
            });
        }
    });
</script>
<?= $this->endSection() ?>