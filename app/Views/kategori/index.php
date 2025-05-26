<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="margin-bottom: 80px;">
    <h2 class="mt-4 mb-4"><?= $title; ?></h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success mb-3" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <a href="/kategori/create" class="btn btn-primary mb-3">Tambah Kategori</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th scope="col" class="py-3">No</th>
                <th scope="col" class="py-3">Nama Kategori</th>
                <th scope="col" class="py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($kategori as $k) : ?>
                <tr>
                    <th scope="row" class="py-3"><?= $i++; ?></th>
                    <td class="py-3"><?= $k['nama_kategori']; ?></td>
                    <td class="py-3">
                        <a href="/kategori/edit/<?= $k['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/kategori/delete/<?= $k['id_kategori']; ?>" 
   class="btn btn-danger btn-sm btn-delete" 
   data-nama="<?= $k['nama_kategori']; ?>">
   Hapus
</a>

                    </td>
                </tr>
            <?php endforeach; ?>
            <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const namaKategori = this.getAttribute('data-nama');
        const href = this.getAttribute('href');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            html: `Kategori <strong>${namaKategori}</strong> akan dihapus!`,
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

        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>