<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h1 class="mb-4 mt-4"><?= esc($title) ?></h1>

<?php if (session()->get('level') === 'Developer') : ?>
    <form id="hapusSemuaPendapatanForm" action="<?= base_url('laporan/hapusSemuaPendapatan') ?>" method="post" class="mb-4">
        <?= csrf_field() ?>
        <button type="button" class="btn btn-danger" id="btn-hapus-semua-pendapatan">Hapus Semua Catatan Pendapatan</button>
    </form>

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
<?php endif; ?>

<form action="<?= base_url('laporan/pendapatan') ?>" method="post" class="mb-5">
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="tanggal_awal" class="col-form-label fw-semibold">Tanggal Awal</label>
        </div>
        <div class="col-auto">
            <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="<?= esc($tanggal_awal ?? '') ?>">
        </div>

        <div class="col-auto">
            <label for="tanggal_akhir" class="col-form-label fw-semibold">Tanggal Akhir</label>
        </div>
        <div class="col-auto">
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="<?= esc($tanggal_akhir ?? '') ?>">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary px-4">Filter</button>
        </div>
    </div>
</form>

<div class="alert alert-info text-center py-4">
    <h4 class="mb-3">Total Seluruh Pendapatan</h4>
    <h3 class="fw-bold">Rp <?= number_format($totalSeluruhPendapatan['total_pendapatan'] ?? 0, 0, ',', '.') ?></h3>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Informasi Penting',
            text: 'Untuk melihat total pendapatan pada periode tertentu, silakan terapkan filter tanggal awal dan tanggal akhir di atas.',
            icon: 'info',
            confirmButtonText: 'OK',
        });
    });
</script>

<?php if (isset($pendapatan)) : ?>
    <div class="alert alert-success text-center py-4 mt-3">
        <h4 class="mb-3">Total Pendapatan Berdasarkan Filter</h4>
        <h3 class="fw-bold">Rp <?= number_format($pendapatan['total_pendapatan'] ?? 0, 0, ',', '.') ?></h3>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>