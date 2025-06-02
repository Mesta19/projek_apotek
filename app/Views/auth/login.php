<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke ApotekKu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative; /* Penting untuk posisi absolut latar belakang */
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?= base_url('uploads/gambar-login.jpg'); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(5px); /* Efek blur hanya di sini */
            opacity: 0.8; /* Opsional: Opasitas */
            z-index: -1; /* Di belakang form */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
            z-index: 10;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background-color: #0056b3;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 8px 8px 0 0;
        }

        .login-header h2 {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 0.3rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-floating input.form-control {
            border-radius: 6px;
            padding: 1rem 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
        }

        .form-floating label {
            font-size: 0.9rem;
            color: #495057;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 6px;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: bold;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: scale(1.01);
        }

        .alert-danger { /* Gaya untuk div error PHP tetap ada, jika ingin ditampilkan bersamaan */
            border-radius: 6px;
            margin-bottom: 1.5rem;
            padding: 1rem;
            font-size: 0.9rem;
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .login-footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.8rem;
            color: #6c757d;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 0 0 8px 8px;
        }

        .login-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="background-image"></div>
    <div class="login-container">
        <div class="login-header">
            <h2>Login ke ApotekKu</h2>
            <p class="lead">Silakan masukkan username dan password Anda.</p>
        </div>
        <div class="login-body">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form action="/auth/proses_login" method="post">
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        value="<?= old('username'); ?>">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="btn btn-primary">Masuk</button>
            </form>
        </div>
        <div class="login-footer">
            <p>&copy; <?= date('Y'); ?> ApotekKu. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const loginForm = document.querySelector('form[action="/auth/proses_login"]');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');

            if (loginForm && usernameInput && passwordInput) {
                loginForm.addEventListener('submit', function (event) {
                    const usernameValue = usernameInput.value.trim();
                    const passwordValue = passwordInput.value.trim();

                    if (usernameValue === '' && passwordValue === '') {
                        event.preventDefault(); 
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: 'Username dan password tidak boleh kosong!',
                        }).then(() => {
                            usernameInput.focus();
                        });
                    } else if (usernameValue === '') {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: 'Username tidak boleh kosong!',
                        }).then(() => {
                            usernameInput.focus();
                        });
                    } else if (passwordValue === '') {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: 'Password tidak boleh kosong!',
                        }).then(() => {
                            passwordInput.focus();
                        });
                    }
                });
            }

            const errorAlertDiv = document.querySelector('.alert.alert-danger');
            if (errorAlertDiv) {
                const errorMessageText = errorAlertDiv.textContent || errorAlertDiv.innerText;
                if (errorMessageText.trim() !== '') {
                    Swal.fire({
                        icon: 'error', // Icon error untuk pesan dari server
                        title: 'Login Gagal',
                        text: errorMessageText.trim(),
                    });
                    // Opsional: Jika Anda ingin menyembunyikan div error Bootstrap setelah SweetAlert muncul
                    // agar tidak ada pesan ganda, Anda bisa uncomment baris berikut:
                    // errorAlertDiv.style.display = 'none'; 
                }
            }
        });
    </script>
</body>

</html>