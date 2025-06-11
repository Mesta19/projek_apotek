<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-4 mb-4"><?= $title; ?></h2>

    <div class="mb-4">
        <h5>Panduan Pengisian Formulir Tambah Kategori</h5>
        <p>Berikut adalah panduan untuk mengisi formulir penambahan kategori obat:</p>
        <ul>
            <li>
                <strong>Nama Kategori:</strong> Masukkan nama kategori obat yang spesifik dan jelas. Contoh kategori obat meliputi:
                <ul>
                    <li>Antibiotik</li>
                    <li>Analgesik</li>
                    <li>Antipiretik</li>
                    <li>Antihistamin</li>
                    <li>Vitamin dan Suplemen</li>
                    <li>Obat Batuk dan Pilek</li>
                    <li>Obat Pencernaan</li>
                    <li>Obat Kulit</li>
                    <li>Obat Jantung</li>
                    <li>Dan lain-lain.</li>
                </ul>
                Pastikan nama kategori mencerminkan jenis atau fungsi obat yang dikelompokkan.
            </li>
        </ul>
    </div>

    <form action="/kategori/save" method="post">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori"
                class="form-control <?= session('errors.nama_kategori') ? 'is-invalid' : '' ?>"
                value="<?= old('nama_kategori') ?>">

            <?php if (session('errors.nama_kategori')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.nama_kategori') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/kategori" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    <div class="container" style="margin-bottom: 80px;">
    </div>
</div>
<?= $this->endSection(); ?>