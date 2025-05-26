<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container" style="margin-bottom: 80px;">
    <h2 class="mt-4 mb-4"><?= $title; ?></h2>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success mb-3" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <a href="/obat/create" class="btn btn-primary mb-3">Tambah Obat</a>

    <table class="table table-bordered">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th style="width: 300px;">Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($obat as $o) : ?>
                <tr>
                    <td class="align-middle text-center"><?= $i++; ?></td>
                    <td class="align-middle text-center">
                        <?php if ($o['gambar']) : ?>
                            <img src="<?= base_url('uploads/' . $o['gambar']); ?>" style="height: 100px; width: 100px; object-fit: contain;">
                        <?php else : ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td class="align-middle"><?= $o['nama_obat']; ?></td>
                    <td class="align-middle"><?= $o['nama_kategori']; ?></td>
                    <td class="align-middle">Rp <?= number_format($o['harga'], 0, ',', '.'); ?></td>
                    <td class="align-middle"><?= $o['stok']; ?></td>
                    <td class="align-middle"><?= $o['satuan']; ?></td>
                    <td class="align-middle"><?= $o['deskripsi']; ?></td>
                    <td class="align-middle text-center">
                        <div class="d-flex flex-column gap-2">
                            <a href="/obat/edit/<?= $o['id_obat']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/obat/delete/<?= $o['id_obat']; ?>" 
   class="btn btn-danger btn-sm btn-delete" 
   data-nama="<?= $o['nama_obat']; ?>">
   Hapus
</a>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const namaObat = this.getAttribute('data-nama');
        const href = this.getAttribute('href');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Obat "${namaObat}" akan dihapus dari data.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
</script>


                            <?php if ($o['barcode']) : ?>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#barcodeModal<?= $o['id_obat']; ?>">Lihat Barcode</button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Loop semua modal di luar tabel -->
<?php foreach ($obat as $o) : ?>
    <?php if ($o['barcode']) : ?>
        <div class="modal fade" id="barcodeModal<?= $o['id_obat']; ?>" tabindex="-1" aria-labelledby="barcodeLabel<?= $o['id_obat']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="barcodeLabel<?= $o['id_obat']; ?>">Barcode - <?= $o['nama_obat']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p><strong>Kode:</strong> <?= pathinfo($o['barcode'], PATHINFO_FILENAME); ?></p>
                        <img src="<?= base_url('barcodes/' . $o['barcode'].'.png'); ?>" class="img-fluid" style="max-height: 150px;">

                        <!-- Tombol download -->
                        <div class="d-flex align-items-center justify-content-center gap-3">
                        <a href="<?= base_url('barcodes/' . $o['barcode'].'.png'); ?>" download class="btn btn-success mt-3">
                            Download Barcode
                        </a>
                    </div>
    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

</div>

<?= $this->endSection(); ?>
