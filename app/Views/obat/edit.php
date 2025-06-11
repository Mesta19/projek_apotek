<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="margin-bottom: 80px; max-width: 700px;">
    <h2 class="mt-4 mb-4"><?= $title; ?></h2>
    <form action="/obat/update/<?= $obat['id_obat']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="gambar_lama" value="<?= $obat['gambar']; ?>">

        <div class="mb-4">
            <label for="nama_obat" class="form-label">Nama Obat</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_obat')) ? 'is-invalid' : ''; ?>" id="nama_obat" name="nama_obat" value="<?= old('nama_obat') ?: $obat['nama_obat']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_obat'); ?>
            </div>
        </div>

        <div class="mb-4">
            <label for="id_kategori" class="form-label">Kategori Obat</label>
            <select class="form-select" id="id_kategori" name="id_kategori">
                <?php foreach ($kategori as $k) : ?>
                    <option value="<?= $k['id_kategori']; ?>" <?= ($obat['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= old('deskripsi') ?: $obat['deskripsi']; ?></textarea>
        </div>

        <div class="mb-4">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga') ?: $obat['harga']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('harga'); ?>
            </div>
        </div>

        <div class="mb-4">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok') ?: $obat['stok']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('stok'); ?>
            </div>
        </div>

        <div class="mb-4">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan') ?: $obat['satuan']; ?>">
        </div>

        <div class="mb-4">
            <label for="gambar" class="form-label">Gambar Obat</label>
            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar">
            <div class="invalid-feedback">
                <?= $validation->getError('gambar'); ?>
            </div>
            <img id="previewImg" src="/uploads/<?= $obat['gambar']; ?>" alt="" class="img-thumbnail mt-2" width="100">
        </div>

        <!-- Tampilkan Barcode lama & tombol Download -->
        <div class="mb-4">
    <label class="form-label">Barcode</label><br>
    <?php
        $barcodeFilename = $obat['barcode'].'.png';
        $barcodeFullPath = FCPATH . 'barcodes/' . $barcodeFilename;
        $barcodeUrl = base_url('barcodes/' . $barcodeFilename);
    ?>

<?php if (!empty($obat['barcode']) && file_exists($barcodeFullPath)) : ?>

    <img src="<?= $barcodeUrl; ?>" alt="Barcode" class="img-fluid" style="max-height: 100px;">

        <p class="mt-2"><?= esc($obat['barcode']); ?></p>
        <a href="<?= base_url('barcodes/' . $obat['barcode'].'.png') ?>" class="btn btn-success mb-3" download="<?= $obat['barcode'] ?>">
    <i class="fas fa-download"></i> Download Barcode PNG
</a>

    <?php else : ?>
        <p><em>Barcode belum tersedia untuk obat ini.</em></p>
    <?php endif; ?>
</div>


        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/obat" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    const gambarInput = document.getElementById('gambar');
    const previewImg = document.getElementById('previewImg');

    gambarInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                previewImg.src = reader.result;
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.src = "/uploads/<?= $obat['gambar']; ?>";
        }
    });
</script>

<?= $this->endSection(); ?>
