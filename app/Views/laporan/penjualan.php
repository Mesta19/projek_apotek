<?= $this->extend('layout/template') ?>

<?php $this->section('title') ?>
<?= (session()->get('level') === 'Developer') ? 'Laporan Penjualan - Akses Developer' : ($title ?? 'Laporan Penjualan') ?>
<?php $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>
        <?= (session()->get('level') === 'Developer') ? 'Laporan Penjualan - Akses Developer' : ($title ?? 'Laporan Penjualan') ?>
    </h2>
    <hr>

    <?php if (session()->get('level') === 'Developer') : ?>
        <form id="hapusSemuaForm" action="<?= base_url('laporan/hapusSemuaTransaksi') ?>" method="post" style="margin-bottom: 20px;">
            <?= csrf_field() ?>
            <button type="button" class="btn btn-danger btn-lg" onclick="konfirmasiHapusSemua()">Hapus Semua Transaksi</button>
        </form>
    <?php endif; ?>

    <form method="get" action="<?= base_url('laporan/penjualan') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
            <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" value="<?= esc($_GET['tanggal_awal'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="<?= esc($_GET['tanggal_akhir'] ?? '') ?>">
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= base_url('laporan/penjualan') ?>" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <?php
    $currentTransaksi = null;
    $grandTotal = 0;
    ?>

    <?php foreach ($laporan as $row): ?>
        <?php if ($currentTransaksi !== $row['id_transaksi']): ?>
            <?php if ($currentTransaksi !== null): ?>
                </tbody>
                </table>
                <p><strong>Total Transaksi: </strong>Rp <?= number_format($grandTotal, 0, ',', '.') ?></p>

                <?php if (session()->get('level') === 'Developer') : ?>
                    <form id="hapusTransaksiForm<?= $currentTransaksi ?>" action="<?= base_url('laporan/hapusTransaksi/' . $currentTransaksi) ?>" method="post" style="display:inline-block; margin-bottom:1rem;">
                        <?= csrf_field() ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="konfirmasiHapusTransaksi('<?= $currentTransaksi ?>')">Hapus Transaksi</button>
                    </form>
                <?php endif; ?>

                <hr>
            <?php endif; ?>

            <?php
            $currentTransaksi = $row['id_transaksi'];
            $grandTotal = 0;
            ?>
            <h5>ID Transaksi: <?= $row['id_transaksi'] ?></h5>
            <p>Tanggal: <?= $row['tanggal_transaksi'] ?></p>
            <p>Kasir: <?= $row['nama_lengkap'] ?></p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
        <?php endif; ?>

        <tr>
            <td><?= $row['nama_obat'] ?? '-' ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td>Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
        </tr>

        <?php $grandTotal += $row['subtotal']; ?>
    <?php endforeach; ?>

    <?php if ($currentTransaksi !== null): ?>
        </tbody>
        </table>
        <p><strong>Total Transaksi: </strong>Rp <?= number_format($grandTotal, 0, ',', '.') ?></p>

        <?php if (session()->get('level') === 'Developer') : ?>
            <form id="hapusTransaksiForm<?= $currentTransaksi ?>" action="<?= base_url('laporan/hapusTransaksi/' . $currentTransaksi) ?>" method="post" style="display:inline-block; margin-bottom:1rem;">
                        <?= csrf_field() ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="konfirmasiHapusTransaksi('<?= $currentTransaksi ?>')">Hapus Transaksi</button>
                    </form>
        <?php endif; ?>

        <hr>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function konfirmasiHapusSemua() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data transaksi akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('hapusSemuaForm').submit();
            }
        })
    }

    function konfirmasiHapusTransaksi(idTransaksi) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Transaksi dengan ID ${idTransaksi} akan dihapus!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('hapusTransaksiForm' + idTransaksi).submit();
            }
        })
    }
</script>
<?= $this->endSection() ?>