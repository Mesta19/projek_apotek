<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2><?= $title; ?></h2>
    <form action="/user/update/<?= $user['id_user']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username') ?? $user['username']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password (kosongkan jika tidak ingin diubah)</label>
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
            <div class="invalid-feedback">
                <?= $validation->getError('password'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <select class="form-control" id="level" name="level">
                <option value="admin" <?= (old('level') ?? $user['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="kasir" <?= (old('level') ?? $user['level'] == 'kasir') ? 'selected' : ''; ?>>Kasir</option>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('level'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?? $user['nama_lengkap']; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_lengkap'); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?= $this->endSection(); ?>