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
                        <button class="btn btn-danger btn-sm btn-hapus" data-id="<?= $u['id_user']; ?>" data-username="<?= $u['username']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".btn-hapus");

        buttons.forEach(function (btn) {
            btn.addEventListener("click", function () {
                const userId = this.getAttribute("data-id");
                const username = this.getAttribute("data-username");

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `User "${username}" akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-trash"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="bi bi-x-circle"></i> Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/user/delete/" + userId;
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection(); ?>
