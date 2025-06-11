<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?? 'Apotek Web'; ?> - ApotekKu</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <style>
        .navbar-fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* Ensure it stays on top */
        }

        /* Adjust padding/margin of the content below the fixed navbar */
        body {
            padding-top: 56px;
            /* Height of the navbar */
        }

        @media (max-width: 991.98px) {
            body {
                padding-top: 0;
                /* Adjust if navbar collapses to a shorter height */
            }

            .navbar-fixed-top {
                position: sticky;
                /* Or adjust behavior on smaller screens */
                top: 0;
                background-color: rgba(33, 37, 41, 0.9);
                /* Optional: slightly transparent background on collapse */
            }
        }

        /* Style untuk tombol logout */
        .logout-button {
            margin-left: 15px;
            /* Memberikan jarak dari item navbar sebelumnya */
            padding: 8px 15px;
            border: 1px solid #6c757d;
            /* Border 1px */
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            background-color: transparent;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
            /* Tambah transisi warna teks */
            display: inline-flex;
            /* Menggunakan flexbox untuk alignment vertikal */
            align-items: center;
            /* Menyusun item secara vertikal di tengah */
            line-height: 1.5;
            /* Sesuaikan line-height agar sejajar */
            font-size: 0.9rem;
            /* Sedikit kurangi ukuran font jika perlu */
            height: calc(2.5rem + 2px);
            /* Sesuaikan tinggi agar sama dengan nav-link (perkiraan) */
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #dc3545;
            /* Warna merah saat hover */
            border-color: #dc3545;
            color: #fff;
            /* Warna teks putih saat hover */
        }

        .logout-button:active {
            background-color: #fff;
            /* Warna putih saat klik (active) */
            border-color: #dc3545;
            color: #dc3545;
            /* Warna teks merah saat klik (active) */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="<?= base_url(); ?>">ApotekKu</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Dashboard') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Obat') ? 'active' : ''; ?>" href="<?= base_url('obat'); ?>">Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Kategori') ? 'active' : ''; ?>" href="<?= base_url('kategori'); ?>">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Transaksi') ? 'active' : ''; ?>" href="<?= base_url('transaksi'); ?>">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Laporan') ? 'active' : ''; ?>" href="<?= base_url('laporan'); ?>">Laporan</a>
                    </li>
                    <?php if (session()->get('level') === 'Developer') : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($navbar == 'User') ? 'active' : ''; ?>" href="<?= base_url('user'); ?>">Akses User</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="#" id="logoutBtn" class="logout-button">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container px-6 px-lg-10">
        <?= $this->renderSection('content'); ?>
    </div>
    <footer class="py-5 bg-dark text-white">
        <div class="container px-4 px-lg-5">
            <div class="row gx-5 gy-4">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Tentang ApotekKu</h5>
                    <p>
                        ApotekKu adalah platform terpercaya untuk pembelian obat-obatan secara mudah dan cepat.
                        Kami berkomitmen memberikan layanan terbaik untuk kesehatan Anda.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-telephone-fill me-2 fs-5"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-envelope-fill me-2 fs-5"></i>
                            <span>info@apotekku.com</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Alamat</h5>
                    <p class="d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill me-2 fs-5 mt-1"></i>
                        <span>Jl. Kaliabang Tengah No. 45,<br>Bekasi Utara, Jawa Barat, 10110</span>
                    </p>
                </div>
            </div>
            <hr class="border-top border-light mt-4" />
            <p class="m-0 text-center small">&copy; ApotekKu <?= date('Y'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('logoutBtn');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah link langsung mengarah ke URL logout

                    Swal.fire({
                        title: 'Apakah Anda yakin ingin keluar?',
                        text: "Anda akan diarahkan ke halaman login.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Logout!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('auth/logout'); ?>"; // Arahkan ke URL logout
                        }
                    });
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('js/scripts.js'); ?>"></script>
</body>

</html>