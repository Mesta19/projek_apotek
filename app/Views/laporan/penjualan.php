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
        <form id="hapusSemuaForm" action="<?= base_url('laporan/hapusSemuaTransaksi') ?>" method="post" class="mb-4">
            <?= csrf_field() ?>
            <button type="button" class="btn btn-danger btn-lg" onclick="konfirmasiHapusSemua()">Hapus Semua Transaksi</button>
        </form>
    <?php endif; ?>

    <div class="card card-body mb-4">
        <h5>Filter Laporan</h5>

        <?php
        // --- [PERUBAHAN 1] Logika untuk filter dan urutan ---
        $request = \Config\Services::request();

        // Ambil parameter tanggal
        $today = date('Y-m-d');
        $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));
        $firstDayOfMonth = date('Y-m-01');
        $getTanggalAwal = $request->getGet('tanggal_awal');
        $getTanggalAkhir = $request->getGet('tanggal_akhir');

        // Ambil parameter urutan (default 'desc' atau terkini)
        $urutan = $request->getGet('urutan') ?? 'desc';
        $nextUrutan = ($urutan === 'desc') ? 'asc' : 'desc';

        // Siapkan teks dan ikon untuk tombol toggle
        $tombolUrutanText = ($urutan === 'desc') ? 'Terkini' : 'Terlampau';
        $tombolUrutanIcon = ($urutan === 'desc') ? 'bi-sort-down' : 'bi-sort-up';

        // Buat URL untuk tombol urutan sambil mempertahankan filter tanggal
        $queryParams = array_filter([
            'tanggal_awal' => $getTanggalAwal,
            'tanggal_akhir' => $getTanggalAkhir,
            'urutan' => $nextUrutan
        ]);
        $urlUrutan = base_url('laporan/penjualan') . '?' . http_build_query($queryParams);

        // Cek status aktif untuk tombol preset
        $isTodayActive = ($getTanggalAwal == $today && $getTanggalAkhir == $today);
        $isWeeklyActive = ($getTanggalAwal == $sevenDaysAgo && $getTanggalAkhir == $today);
        $isMonthlyActive = ($getTanggalAwal == $firstDayOfMonth && $getTanggalAkhir == $today);
        $isCustomActive = !empty($getTanggalAwal) && !($isTodayActive || $isWeeklyActive || $isMonthlyActive);
        ?>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <a href="<?= base_url('laporan/penjualan') ?>?tanggal_awal=<?= $today ?>&tanggal_akhir=<?= $today ?>" class="btn <?= $isTodayActive ? 'btn-primary' : 'btn-outline-primary' ?>">Hari Ini</a>
            <a href="<?= base_url('laporan/penjualan') ?>?tanggal_awal=<?= $sevenDaysAgo ?>&tanggal_akhir=<?= $today ?>" class="btn <?= $isWeeklyActive ? 'btn-primary' : 'btn-outline-primary' ?>">Minggu Ini</a>
            <a href="<?= base_url('laporan/penjualan') ?>?tanggal_awal=<?= $firstDayOfMonth ?>&tanggal_akhir=<?= $today ?>" class="btn <?= $isMonthlyActive ? 'btn-primary' : 'btn-outline-primary' ?>">Bulan Ini</a>
            <a href="<?= base_url('laporan/penjualan') ?>" class="btn btn-secondary">Reset</a>
            <button class="btn <?= $isCustomActive ? 'btn-primary' : 'btn-outline-primary' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCustomDate" aria-expanded="<?= $isCustomActive ? 'true' : 'false' ?>" aria-controls="collapseCustomDate">
                Pilih Tanggal Sendiri
            </button>
        </div>

        <div class="collapse <?= $isCustomActive ? 'show' : '' ?>" id="collapseCustomDate">
            <form method="get" action="<?= base_url('laporan/penjualan') ?>" class="row g-3 border-top pt-3">
                <div class="col-md-4">
                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" value="<?= esc($getTanggalAwal) ?>">
                </div>
                <div class="col-md-4">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="<?= esc($getTanggalAkhir) ?>">
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= $urlUrutan ?>" class="btn btn-outline-dark">
            <i class="bi <?= $tombolUrutanIcon ?>"></i>
            Urutan: <?= $tombolUrutanText ?>
        </a>
    </div>

    <?php
    $currentTransaksi = null;
    $totalTransaksi = 0;
    ?>

    <?php if (empty($laporan)): ?>
        <div class="alert alert-info">Tidak ada data transaksi pada rentang tanggal yang dipilih.</div>
    <?php else: ?>
        <?php foreach ($laporan as $row): ?>
            <?php if ($currentTransaksi !== $row['id_transaksi']): ?>
                <?php if ($currentTransaksi !== null): ?>
                    </tbody>
                    </table>
                    <div class="text-end">
                        <p><strong>Total Transaksi: </strong>Rp <?= number_format($totalTransaksi, 0, ',', '.') ?></p>
                        <?php if (session()->get('level') === 'Developer') : ?>
                            <form id="hapusTransaksiForm<?= $currentTransaksi ?>" action="<?= base_url('laporan/hapusTransaksi/' . $currentTransaksi) ?>" method="post" style="display:inline-block;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm mb-3" onclick="konfirmasiHapusTransaksi('<?= $currentTransaksi ?>')">Hapus Transaksi Ini</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <hr>
                <?php endif; ?>

                <?php
                $currentTransaksi = $row['id_transaksi'];
                $totalTransaksi = 0;
                ?>
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>ID Transaksi: <?= $row['id_transaksi'] ?></h5>
                        <p class="mb-1">Tanggal: <?= date('d F Y, H:i:s', strtotime($row['tanggal_transaksi'])) ?></p>
                        <p class="mb-1">Kasir: <?= $row['nama_lengkap'] ?></p>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Obat</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php endif; ?>

                    <tr>
                        <td><?= $row['nama_obat'] ?? '-' ?></td>
                        <td class="text-center"><?= $row['jumlah'] ?></td>
                        <td class="text-end">Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                    </tr>

                    <?php $totalTransaksi += $row['subtotal']; ?>
                <?php endforeach; ?>

                <?php if ($currentTransaksi !== null): ?>
                    </tbody>
                </table>
                <div class="text-end">
                    <p><strong>Total Transaksi: </strong>Rp <?= number_format($totalTransaksi, 0, ',', '.') ?></p>
                    <?php if (session()->get('level') === 'Developer') : ?>
                        <form id="hapusTransaksiForm<?= $currentTransaksi ?>" action="<?= base_url('laporan/hapusTransaksi/' . $currentTransaksi) ?>" method="post" style="display:inline-block;">
                            <?= csrf_field() ?>
                            <button type="button" class="btn btn-danger btn-sm mb-3" onclick="konfirmasiHapusTransaksi('<?= $currentTransaksi ?>')">Hapus Transaksi Ini</button>
                        </form>
                    <?php endif; ?>
                </div>
                <hr>
            <?php endif; ?>
        <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // ... fungsi JavaScript Anda ...
</script>
<?= $this->endSection() ?>