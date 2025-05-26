<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-4 mb-4"><?= $title; ?></h2>
    <form action="/kategori/update/<?= $kategori['id_kategori']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3"> <label for="nama_kategori" class="form-label">Nama Kategori</label> <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/kategori" class="btn btn-secondary">Batal</a>
    </form>
    <div style="margin-bottom: 80px;">
    </div>
</div>
<?= $this->endSection(); ?>