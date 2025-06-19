<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2><?= $title; ?></h2>
    <form action="/user/update/<?= $user['id_user']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username') ?? $user['username']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password (kosongkan jika tidak ingin diubah)</label>
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
            <div class="invalid-feedback">
                <?= $validation->getError('password'); ?>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="level">Level</label>
            <select class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" id="level" name="level">
    <?php if (session()->get('level') === 'Developer') : ?>
        <option value="Developer" <?= (old('level') ?? $user['level']) === 'Developer' ? 'selected' : ''; ?>>Admin / Developer</option>
    <?php endif; ?>
    <option value="kasir" <?= (old('level') ?? $user['level']) === 'kasir' ? 'selected' : ''; ?>>Kasir</option>
</select>
<div class="invalid-feedback">
    <?= $validation->getError('level'); ?>
</div>

            
            <div class="invalid-feedback">
                <?= $validation->getError('level'); ?>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?? $user['nama_lengkap']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_lengkap'); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/user" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
<?= $this->endSection(); ?>
