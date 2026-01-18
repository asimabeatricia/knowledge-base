<?= $this->extend($config->viewLayout) ?>
<?php $this->setVar('title', 'Login'); ?>
<?= $this->section('main') ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<div class="login-bg">
    <div class="login-card">
        <div class="text-center mt-2 mb-3">
            <img src="/img/logoWarna.png" alt="Logo" style="max-height: 70px">
        </div>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success mx-4">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <div class="row align-items-center">
            <div class="col-12 col-md-6 px-4 py-4">
                <h3 class="mb-4 text-primary" style="color:#3A85D3 !important;">Selamat Datang Kembali!</h3>

                <form action="<?= url_to('login') ?>" method="post" autocomplete="off">
                    <?= csrf_field() ?>
                    <div class="form-group mb-3">
                        <label for="login" class="font-weight-bold">Username <span class="text-danger">*</span></label>
                        <input type="text" name="login" id="login" class="form-control input-gradient <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="Masukkan username Anda" value="<?= old('login') ?>">
                        <div class="invalid-feedback">
                            <?php
                            $err = session('errors.login');
                            if ($err == 'Kolom login harus diisi.') {
                                echo 'Kolom username harus diisi.';
                            } else {
                                echo $err;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group mb-3 position-relative">
                        <label for="password" class="font-weight-bold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password"
                            class="form-control input-gradient pr-5 <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                            placeholder="Masukkan password Anda">
                        <i id="toggleIcon" class="fa-solid fa-eye position-absolute" onclick="togglePassword()" style="top: 45px; right: 15px; cursor: pointer; z-index: 10;"></i>
                        <?php if (session('errors.password')): ?>
                            <div class="invalid-feedback" style="display:block;">
                                <?= session('errors.password') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                            <label class="form-check-label" for="remember" style="font-size: 15px;">Biarkan saya tetap masuk</label>
                        </div>
                        <?php if ($config->activeResetter) : ?>
                            <a href="<?= url_to('forgot') ?>" class="text-primary" style="font-size: 15px; text-decoration: underline;">Lupa password?</a>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block custom-login-btn mb-3">LOG IN</button>
                    <div class="text-center" style="font-size: 15px;">
                        Belum memiliki akun?
                        <?php if ($config->allowRegistration) : ?>
                            <a href="<?= url_to('register') ?>" class="text-primary font-weight-bold">Buat Akun</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <div class="d-none d-md-block col-md-1 text-center">
                <div class="vertical-line"></div>
            </div>
            <div class="d-none d-md-block col-md-5 text-center">
                <img src="/img/LoginAsset1.png" alt="Ilustrasi" class="img-fluid" style="max-height:340px;">
            </div>
        </div>
        <button type="button" class="close login-close-btn" onclick="window.location.href='/'" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<style>
    body,
    html {
        height: 100vh;
        margin: 0;
        padding: 0;
        width: 100vw;
        overflow: hidden;
    }

    .login-bg {
        min-height: 100vh;
        height: 100vh;
        width: 100vw;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
    }

    .login-card {
        width: 95%;
        max-width: 1080px;
        background: #fff;
        border-radius: 32px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.13);
        padding: 3.5rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index: 1;
        box-sizing: border-box;
        position: relative;
        padding-top: 2.5rem;
    }


    .alert {
        margin-bottom: 1.2rem;
        margin-top: 0.5rem;
        overflow: visible;
        max-width: 100%;
        word-break: break-word;
        position: static;
        width: 90%;
        left: unset;
        top: unset;
        transform: none;
        z-index: 1;
        text-align: center;
    }

    .vertical-line {
        border-left: 2px solid #e0e0e0;
        height: 340px;
        margin: 0 auto;
    }

    .login-close-btn {
        position: absolute;
        top: 40px;
        right: 80px;
        background: #fff;
        border: none;
        font-size: 1.5rem;
        color: #2986E2;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s, color 0.2s;
        z-index: 10;
        outline: none;
    }

    .login-close-btn span {
        font-size: 2rem;
        color: #2986E2;
        font-weight: 400;
        line-height: 1;
    }

    .login-close-btn:hover {
        background: #f2f2f2;
    }

    .login-close-btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px #e3f0fc;
    }

    .input-gradient {
        border: 2px solid transparent;
        border-radius: 15px;
        padding: 1rem 1.2rem;
        font-size: 1.15rem;
        background-image:
            linear-gradient(#fff, #fff),
            linear-gradient(90deg, #2986E2, #43e97b);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        transition: box-shadow 0.2s, border-color 0.2s;
        width: 100%;
    }

    .input-gradient:focus {
        outline: none;
        box-shadow: 0 0 0 2px #e3f0fc;
    }

    .input-gradient.is-invalid {
        border: 2px solid #dc3545 !important;
        background-image: none !important;
    }

    .custom-login-btn {
        border-radius: 28px;
        font-size: 1.15rem;
        font-weight: bold;
        background: #226DA8;
        border: none;
        padding: 0.8rem 0;
        letter-spacing: 1px;
        transition: background 0.2s;
    }

    a.text-primary {
        text-decoration: none !important;
    }

    .custom-login-btn:hover {
        background: #1761a0;
    }

    @media (max-width: 991.98px) {
        .login-card {
            padding: 2rem 0.5rem;
            max-width: 98vw;
            min-height: 500px;
            width: 100%;
            height: auto;
        }

        .vertical-line {
            display: none;
        }
    }

    @media (max-width: 767.98px) {
        .login-card {
            border-radius: 18px;
            padding: 1.2rem 0.2rem;
            max-width: 100vw;
            width: 100%;
            height: auto;
        }

        .vertical-line,
        .col-md-5 {
            display: none !important;
        }

        .login-card img.img-fluid {
            max-height: 120px;
        }
    }

    #toggleIcon {
        color: #666;
    }

    #toggleIcon:hover {
        color: #000;
    }

    .form-check-input[type="checkbox"] {
        accent-color: #2986E2 !important;
    }
</style>

<?= $this->endSection() ?>