<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="margin-bottom: 80px;">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mt-4 mb-4">Tambah Obat</h2>
        <button id="scroll-to-form" class="btn btn-primary btn-md" title="Scroll ke Form Pengisian">
            <i class="fas fa-arrow-down"></i> <span class="d-none d-md-inline">Ke Form</span>
        </button>
    </div>
    <?php if (session()->get('errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong>
            <ul>
                <?php foreach (session()->get('errors') as $error) : ?>
                    <li><?= $error ?></li> <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>
    <h2 class="mt-4 mb-4 text-center text-primary">Panduan Pengisian Form Tambah Obat</h2>
    <div class="card shadow-lg mb-5">
        <div class="card-body">
            <p class="card-text mb-4">
                Berikut adalah panduan untuk mengisi formulir penambahan obat. Mohon ikuti petunjuk di bawah ini untuk memastikan data obat yang Anda masukkan benar dan lengkap.
            </p>
            <ol class="list-unstyled">
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-info-circle mr-2"></i>Kategori Obat:</strong> Pilih jenis obat yang sesuai dari daftar. Contoh kategori obat meliputi:
                    <ul class="ml-4">
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Antiseptik</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Antibiotik</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Analgesik (Pereda Nyeri)</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Antipiretik (Penurun Demam)</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Vitamin</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Dan lain-lain.</li>
                    </ul>
                </li>
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-flask mr-2"></i>Satuan:</strong> Isi dengan satuan kemasan atau bentuk obat. Beberapa contoh satuan yang umum digunakan:
                    <ul class="ml-4">
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Kapsul</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Sirup</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Bubuk</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Tablet</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Ampul</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Vial</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Tube</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Botol</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Strip</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Kotak</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Dan lain-lain.</li>
                    </ul>
                </li>
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-file-signature mr-2"></i>Nama Obat:</strong> Masukkan nama lengkap obat.
                </li>
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-file-alt mr-2"></i>Deskripsi:</strong> Berikan deskripsi singkat mengenai obat.
                </li>
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-money-bill-wave mr-2"></i>Harga:</strong> Masukkan harga per satuan obat (sesuai dengan satuan yang dipilih).
                </li>
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-cubes mr-2"></i>Stok:</strong> Masukkan jumlah stok obat yang tersedia.
                </li>
                <li class="py-2">
                    <strong class="text-info"><i class="fas fa-image mr-2"></i>Gambar Obat:</strong> Pilih file gambar obat jika tersedia. Format gambar yang didukung adalah JPG, PNG, dan GIF.
                </li>
                <li class="py-2">
                <strong class="text-info"><i class="fas fa-image mr-2"></i>Kode Barcode:</strong> Simpan dan Download Barcode. lalu Rename menjadi nama obat.
                </li>
            </ol>
        </div>
    </div>

    <form id="form-tambah-obat" action="/obat/save" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="form-group mb-3">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_obat')) ? 'is-invalid' : ''; ?>" id="nama_obat" name="nama_obat" value="<?= old('nama_obat'); ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_obat'); ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="id_kategori">Kategori Obat</label>
            <select class="form-control <?= (isset($validation) && $validation->hasError('id_kategori')) ? 'is-invalid' : ''; ?>" id="id_kategori" name="id_kategori">
    <?php foreach ($kategori as $k) : ?>
        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
    <?php endforeach; ?>
</select>

            <div class="invalid-feedback">
                <?= $validation->getError('id_kategori'); ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi"><?= old('deskripsi'); ?></textarea>
            <div class="invalid-feedback">
                <?= $validation->getError('deskripsi'); ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('harga'); ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok'); ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('stok'); ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" id="satuan" name="satuan" value="<?= old('satuan'); ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('satuan'); ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="gambar" class="form-label">Gambar Obat</label>
            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar">
            <div class="invalid-feedback">
                <?= $validation->getError('gambar'); ?>
            </div>
            <img id="previewImg" src="#" alt="Preview" class="img-thumbnail mt-2" width="100" style="display: none;">
        </div>
<!-- Input hidden untuk barcode -->
<input type="hidden" name="barcode" value="<?= $barcode ?>">

<!-- Preview barcode -->
<div class="mb-3 d-flex align-items-center">
    <p class="mb-0 me-3"><strong>Kode Barcode: <?= $barcode ?></strong></p>
    <img src="data:image/png;base64,<?= $barcodeImage ?>" alt="Barcode" style="height: 40px;">
    <a href="<?= base_url('barcodes/' . $barcode . '.png') ?>" class="btn btn-success ms-3" download="<?= $barcode ?>.png">
        <i class="fas fa-download"></i> Download Barcode
    </a>
</div>

<!-- Tombol Simpan -->
<button type="submit" class="btn btn-primary">
    <i class="fas fa-save me-2"></i>Simpan
</button>

    </form>
</div>


<script>
    const gambarInput = document.getElementById('gambar');
    const previewImg = document.getElementById('previewImg');
    const scrollToFormBtn = document.getElementById('scroll-to-form');
    const namaObatInput = document.getElementById('nama_obat');

    gambarInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                previewImg.src = reader.result;
                previewImg.style.display = "block";
            }
            reader.readAsDataURL(file);
        } else {
            previewImg.style.display = "none";
            previewImg.src = "#";
        }
    });

    scrollToFormBtn.addEventListener('click', function() {
        window.scrollTo({
            top: namaObatInput.offsetTop - 100,
            behavior: 'smooth'
        });
    });
</script>
<?= $this->endSection(); ?>