<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-4 mb-4"><?= str_replace('Users', 'Admin', $title); ?></h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success mb-3" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <a href="/user/create" class="btn btn-primary mb-3">Tambah User</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th scope="col" class="py-3">No</th>
                <th scope="col" class="py-3">Username</th>
                <th scope="col" class="py-3">Nama Lengkap</th>
                <th scope="col" class="py-3">Level</th>
                <th scope="col" class="py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($users as $u) : ?>
                <tr>
                    <th scope="row" class="py-3"><?= $i++; ?></th>
                    <td class="py-3"><?= $u['username']; ?></td>
                    <td class="py-3"><?= $u['nama_lengkap']; ?></td>
                    <td class="py-3"><?= $u['level']; ?></td>
                    <td class="py-3">
                        <a href="/user/edit/<?= $u['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/user/delete/<?= $u['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>