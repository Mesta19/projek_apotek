<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-4">
    <h2 class="mb-4"><?= $title; ?></h2>
    <form action="/user/save" method="post">
        <?= csrf_field(); ?>

        <div class="form-group mb-3">
            <label for="username" class="mb-2">Username</label>
            <input
                type="text"
                class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"
                id="username"
                name="username"
                value="<?= old('username'); ?>"
            >
            <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="password" class="mb-2">Password</label>
            <input
                type="password"
                class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                id="password"
                name="password"
            >
            <div class="invalid-feedback">
                <?= $validation->getError('password'); ?>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="level" class="mb-2">Wewenang</label>
            <select class="form-control" id="level" name="level">
            <?php if (session()->get('level') === 'Developer') : ?>
                    <option value="Developer">Admin / Developer</option>
                <?php endif; ?>
                <option value="kasir">Kasir</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nama_lengkap" class="mb-2">Nama Lengkap</label>
            <input
                type="text"
                class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>"
                id="nama_lengkap"
                name="nama_lengkap"
                value="<?= old('nama_lengkap'); ?>"
            >
            <div class="invalid-feedback">
                <?= $validation->getError('nama_lengkap'); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
<?= $this->endSection(); ?>