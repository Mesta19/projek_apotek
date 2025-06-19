<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <h2 class="mb-4"><?= $title ?></h2>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Scan Barcode Obat</h5>
                    <form id="barcode-form" method="post" action="<?= base_url('obat/ajaxCariBarcode'); ?>">
                        <input type="hidden" name="barcode" id="barcode">
                    </form>
                    <div id="scanner-container" class="w-100" style="height: 240px; background: #000; border-radius: 8px; overflow: hidden;"></div>
                    <small class="text-muted d-block mt-2">Arahkan kamera ke barcode OBAT untuk menambah ke keranjang.</small>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Input Manual Nama Obat</h5>
                    <form id="manual-input-form">
                        <div class="mb-3">
                            <label for="nama_obat_manual" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat_manual" name="nama_obat" placeholder="Masukkan nama obat..." list="suggestions" autocomplete="off" required>
                            <datalist id="suggestions"></datalist>

                        </div>
                        <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                    </form>
                    <small class="text-muted d-block mt-2">Gunakan ini jika scan barcode bermasalah.</small>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Keranjang Transaksi</h5>

                    <?php if (!empty($keranjang)) : ?>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>
                                    <?php foreach ($keranjang as $id_obat => $item): ?>
                                        <?php $total += $item['subtotal']; ?>
                                        <tr>
                                            <td><?= esc($item['nama_obat']) ?></td>
                                            <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                            <td>
                                                <form action="<?= base_url('transaksi/updateJumlah') ?>" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="id_obat" value="<?= $id_obat ?>">
                                                    <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" class="form-control form-control-sm" style="width: 70px;" required>
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">Ubah</button>
                                                </form>
                                            </td>
                                            <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <form method="post" class="d-inline form-hapus-item" data-id="<?= $id_obat ?>" data-nama="<?= esc($item['nama_obat']) ?>">
                                                    <input type="hidden" name="id_obat" value="<?= $id_obat ?>">
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <th colspan="3" class="text-end">Total</th>
                                        <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            // ... script untuk batal ...

                            const hapusButtons = document.querySelectorAll('.btn-hapus-item');
                            hapusButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const form = this.closest('.form-hapus-item');
                                    const idObat = form.dataset.id;
                                    const namaObat = form.dataset.nama;

                                    Swal.fire({
                                        title: 'Yakin hapus item?',
                                        text: `Anda akan menghapus ${namaObat} dari keranjang.`,
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya, hapus',
                                        cancelButtonText: 'Tidak, batalkan',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            form.action = '<?= base_url('transaksi/hapusItem') ?>';
                                            form.submit();
                                        }
                                    });
                                });
                            });
                        </script>

                        <form action="<?= base_url('transaksi/proses') ?>" method="post" id="form-bayar" target="_blank">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Total Bayar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="Rp <?= number_format($total, 0, ',', '.') ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="dibayar" class="col-sm-3 col-form-label">Uang Dibayar</label>
                                <div class="col-sm-9">
                                    <input type="number" name="bayar" id="dibayar" class="form-control" required min="<?= $total ?>" placeholder="Masukkan jumlah uang dibayar">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
                                <div class="col-sm-9">
                                    <input type="text" id="kembalian" class="form-control" readonly value="Rp 0">
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" class="btn btn-success">Proses Transaksi</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <button type="button" class="btn btn-danger" id="btn-batal">Batal / Kosongkan Keranjang</button>
                        </div>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            document.getElementById('btn-batal').addEventListener('click', function() {
                                Swal.fire({
                                    title: 'Yakin batal transaksi?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya, batal',
                                    cancelButtonText: 'Tidak',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch('<?= base_url('transaksi/clearKeranjang') ?>', {
                                                method: 'POST',
                                                headers: {
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                }
                                            })
                                            .then((res) => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    Swal.fire('Dibatalkan', 'Keranjang telah dikosongkan.', 'success')
                                                        .then(() => window.location.reload());
                                                } else {
                                                    Swal.fire('Gagal', 'Gagal mengosongkan keranjang.', 'error');
                                                }
                                            })
                                            .catch(err => {
                                                console.error(err);
                                                Swal.fire('Gagal', 'Terjadi kesalahan saat membatalkan transaksi.', 'error');
                                            });
                                    }
                                });
                            });
                        </script>

                    <?php else : ?>
                        <p class="text-muted">Keranjang kosong. Silakan scan barcode obat atau masukkan nama obat secara manual.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('transaksi_selesai')) :
    $nota = session()->getFlashdata('transaksi_selesai');
?>
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Nota Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-sm table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nota['keranjang'] as $item): ?>
                            <tr>
                                <td><?= esc($item['nama_obat']) ?></td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td><?= $item['jumlah'] ?></td>
                                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p><strong>Total:</strong> Rp <?= number_format($nota['total'], 0, ',', '.') ?></p>
            <p><strong>Dibayar:</strong> Rp <?= number_format($nota['bayar'], 0, ',', '.') ?></p>
            <p><strong>Kembalian:</strong> Rp <?= number_format($nota['kembalian'], 0, ',', '.') ?></p>
        </div>
    </div>
<?php endif; ?>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputObat = document.getElementById("nama_obat_manual");
        const suggestionList = document.getElementById("suggestions");

        inputObat.addEventListener("input", function() {
            const keyword = this.value;
            if (keyword.length < 2) return; // hanya cari jika input > 1 karakter

            fetch("<?= base_url('obat/ajaxNamaSuggestions') ?>?q=" + encodeURIComponent(keyword), {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    suggestionList.innerHTML = "";
                    data.forEach(obat => {
                        const option = document.createElement("option");
                        option.value = obat.nama_obat;
                        suggestionList.appendChild(option);
                    });
                })
                .catch(err => {
                    console.error("Gagal mengambil suggestion:", err);
                });
        });

        const scannerContainer = document.getElementById("scanner-container");
        const html5QrCode = new Html5Qrcode("scanner-container");
        const config = {
            fps: 40,
            qrbox: {
                width: 250,
                height: 250
            }
        };
        let scanning = false;

        const onScanSuccess = (decodedText, decodedResult) => {
            if (scanning) return;
            scanning = true;
            scannerContainer.style.borderColor = 'blue';

            console.log("Barcode terbaca:", decodedText);

            fetch("<?= base_url('obat/ajaxCariBarcode') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        barcode: decodedText
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || "Obat tidak ditemukan");
                        scanning = false;
                    }
                })
                .catch(err => {
                    console.error("Gagal:", err);
                    alert("Terjadi kesalahan.");
                    scanning = false;
                });
        };

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                html5QrCode.start({
                        facingMode: "environment"
                    }, // kamera belakang
                    config,
                    onScanSuccess
                ).catch(err => {
                    console.error("Gagal memulai kamera:", err);
                    alert("Tidak bisa mengakses kamera.");
                });
            } else {
                alert("Tidak ada kamera ditemukan.");
            }
        }).catch(err => {
            console.error("Error kamera:", err);
            alert("Gagal mengakses kamera.");
        });

        // --- Script untuk Input Manual Nama Obat ---
        const manualInputForm = document.getElementById("manual-input-form");
        manualInputForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah form submit secara default

            const namaObatManual = document.getElementById("nama_obat_manual").value;

            fetch("<?= base_url('obat/ajaxCariNama') ?>", { // Anda perlu membuat endpoint ini
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        nama_obat: namaObatManual
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload(); // Muat ulang halaman untuk menampilkan keranjang yang diperbarui
                    } else {
                        alert(data.message || "Obat dengan nama tersebut tidak ditemukan.");
                    }
                })
                .catch(err => {
                    console.error("Gagal:", err);
                    alert("Terjadi kesalahan saat mencari obat.");
                });
        });
        // --- Akhir Script untuk Input Manual Nama Obat ---
    });

    const inputDibayar = document.getElementById("dibayar");
    const inputKembalian = document.getElementById("kembalian");
    const formBayar = document.getElementById("form-bayar");
    let totalBayar = <?= isset($total) ? $total : 0 ?>;

    inputDibayar.addEventListener("input", () => {
        const dibayar = parseInt(inputDibayar.value) || 0;
        const kembalian = dibayar - totalBayar;
        inputKembalian.value = kembalian >= 0 ? "Rp " + kembalian.toLocaleString("id-ID") : "Rp 0";
    });

    formBayar.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah submit form biasa

        const formData = new FormData(this);

        fetch('<?= base_url('transaksi/proses') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Penting untuk CodeIgniter
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Buka tab baru dengan URL struk
                    window.open('<?= base_url('transaksi/struk/') ?>' + data.id_transaksi, '_blank');
                    // Redirect kembali ke halaman transaksi setelah struk dibuka (opsional)
                    window.location.href = '<?= base_url('transaksi') ?>';
                } else {
                    alert(data.message || 'Gagal memproses transaksi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses transaksi.');
            });
    });
</script>

<?= $this->endSection(); ?>