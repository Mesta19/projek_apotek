<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="ApotekKu - Platform terpercaya untuk pembelian obat-obatan secara mudah dan cepat" />
    <meta name="author" content="ApotekKu Team" />
    <title><?= $title ?? 'Apotek Web'; ?> - ApotekKu</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="<?= base_url('css/modern_styles.css'); ?>" rel="stylesheet" />

    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top fade-in-up">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand fw-bold pulse-hover" href="<?= base_url(); ?>">
                <i class="bi bi-heart-pulse me-2"></i>ApotekKu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Dashboard') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>">
                            <i class="bi bi-house-door me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Obat') ? 'active' : ''; ?>" href="<?= base_url('obat'); ?>">
                            <i class="bi bi-capsule me-1"></i>Obat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Kategori') ? 'active' : ''; ?>" href="<?= base_url('kategori'); ?>">
                            <i class="bi bi-tags me-1"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Transaksi') ? 'active' : ''; ?>" href="<?= base_url('transaksi'); ?>">
                            <i class="bi bi-credit-card me-1"></i>Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($navbar == 'Laporan') ? 'active' : ''; ?>" href="<?= base_url('laporan'); ?>">
                            <i class="bi bi-graph-up me-1"></i>Laporan
                        </a>
                    </li>
                    <?php if (session()->get('level') === 'Developer') : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($navbar == 'User') ? 'active' : ''; ?>" href="<?= base_url('user'); ?>">
                                <i class="bi bi-people me-1"></i>Akses User
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="#" id="logoutBtn" class="logout-button">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid px-4 px-lg-5 fade-in-up">
        <div class="content-wrapper">
            <?= $this->renderSection('content'); ?>
        </div>
    </main>

    <footer class="py-5 text-white mt-auto fade-in-up">
        <div class="container px-4 px-lg-5">
            <div class="row gx-5 gy-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-heart-pulse me-2"></i>Tentang ApotekKu
                    </h5>
                    <p>
                        ApotekKu adalah platform terpercaya untuk pembelian obat-obatan secara mudah dan cepat.
                        Kami berkomitmen memberikan layanan terbaik untuk kesehatan Anda dengan teknologi modern
                        dan pelayanan yang ramah.
                    </p>
                    <div class="d-flex align-items-center mt-3">
                        <div class="badge bg-success me-2">
                            <i class="bi bi-shield-check me-1"></i>Terpercaya
                        </div>
                        <div class="badge bg-primary me-2">
                            <i class="bi bi-lightning me-1"></i>Cepat
                        </div>
                        <div class="badge bg-warning">
                            <i class="bi bi-award me-1"></i>Berkualitas
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-telephone me-2"></i>Kontak Kami
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <strong>Telepon</strong><br>
                                <span>(021) 1234-5678</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <strong>Email</strong><br>
                                <span>info@apotekku.com</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <div class="contact-icon me-3">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <strong>WhatsApp</strong><br>
                                <span>0812-3456-7890</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-geo-alt me-2"></i>Lokasi Kami
                    </h5>
                    <div class="d-flex align-items-start mb-3">
                        <div class="contact-icon me-3 mt-1">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <strong>Alamat Utama</strong><br>
                            <span>Jl. Kaliabang Tengah No. 45,<br>Bekasi Utara, Jawa Barat, 17125</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="contact-icon me-3">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div>
                            <strong>Jam Operasional</strong><br>
                            <span>Senin - Sabtu: 08:00 - 22:00<br>Minggu: 09:00 - 21:00</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-top border-light my-4" />

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="m-0 small">
                        <i class="bi bi-c-circle me-1"></i>
                        Copyright &copy; ApotekKu <?= date('Y'); ?>. All rights reserved.
                    </p>
                    <p class="m-0 small text-muted">
                        Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> untuk kesehatan Indonesia
                    </p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="social-links">
                        <a href="#" class="text-white me-2" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="text-white me-2" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="text-white me-2" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="text-white" title="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logout functionality with enhanced SweetAlert
            const logoutBtn = document.getElementById('logoutBtn');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Konfirmasi Logout',
                        text: "Apakah Anda yakin ingin keluar dari sistem?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: '<i class="bi bi-box-arrow-right me-1"></i>Ya, Logout!',
                        cancelButtonText: '<i class="bi bi-x-circle me-1"></i>Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'animated fadeInDown',
                            confirmButton: 'btn btn-danger mx-2',
                            cancelButton: 'btn btn-secondary mx-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Logging out...',
                                text: 'Mohon tunggu sebentar',
                                icon: 'info',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                customClass: {
                                    popup: 'animated fadeIn'
                                },
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Redirect after short delay for better UX
                            setTimeout(() => {
                                window.location.href = "<?= base_url('auth/logout'); ?>";
                            }, 1000);
                        }
                    });
                });
            }

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/scripts.js'); ?>"></script>
</body>

</html>