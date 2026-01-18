<?= $this->extend($config->viewLayout) ?>
<?php $this->setVar('title', 'Buat Akun'); ?>
<?= $this->section('main') ?>

<head>
    <link rel="stylesheet" href="/css/register-custom.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>


<div class="container">




    <div class="register-container">
        <img src="/img/logoWarna.png" alt="BPJS Ketenagakerjaan" class="logo mb-4">
        <h2 class="register-title">Buat Akun</h2>
        <form method="post" action="/register" class="register-form">
            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" placeholder="Masukkan email Anda"
                class="form-control input-gradient <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                value="<?= old('email') ?>">
            <?php if (session('errors.email')): ?>
                <div class="invalid-feedback" style="display:block;">
                    <?= session('errors.email') ?>
                </div>
            <?php endif; ?>

            <label>Username <span class="required">*</span></label>
            <input type="text" name="username" placeholder="Masukkan username Anda"
                class="form-control input-gradient <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                value="<?= old('username') ?>">
            <?php if (session('errors.username')): ?>
                <div class="invalid-feedback" style="display:block;">
                    <?= session('errors.username') ?>
                </div>
            <?php endif; ?>

            <label>Password <span class="required">*</span></label>
            <div class="position-relative">
                <input type="password" name="password" id="password" placeholder="Masukkan password Anda"
                    class="form-control input-gradient <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>">
                <i class="fa-solid fa-eye toggle-password" id="togglePassword" style="top: 43%; right: 16px;"></i>
                <?php if (session('errors.password')): ?>
                    <div class="invalid-feedback" style="display:block;">
                        <?= session('errors.password') ?>
                    </div>
                <?php endif; ?>
            </div>

            <label>Konfirmasi Password <span class="required">*</span></label>
            <div class="position-relative">
                <input type="password" name="pass_confirm" id="pass_confirm" placeholder="Masukkan password Anda kembali"
                    class="form-control input-gradient <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>">
                <i class="fa-solid fa-eye toggle-password" id="toggleConfirmPassword" style="top: 43%; right: 16px;"></i>
                <?php if (session('errors.pass_confirm')): ?>
                    <div class="invalid-feedback" style="display:block;">
                        <?= session('errors.pass_confirm') ?>
                    </div>
                <?php endif; ?>
            </div>


            <button type="submit" class="register-btn">Buat Akun</button>
        </form>
        <div class="register-footer">
            Sudah memiliki akun? <a href="/login">Login</a>
        </div>
    </div>
</div>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('pass_confirm');

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>


<style>
    html,
    body {
        height: 100vh;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    body {
        background: #fff;
        font-family: 'Poppins', Arial, sans-serif;
    }

    .register-container {
        max-width: 600px;
        margin: 40px auto;
        margin-top: 5px;
        background: #fff;
        border-radius: 16px;
        /* box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07); */
        padding: 32px 24px 16px 24px;
        text-align: center;
    }

    .logo {
        width: 250px;
        height: auto;
        margin-bottom: 8px;
    }

    .register-title {
        color: #3A85D3;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .register-form {
        text-align: left;
    }

    .register-form label {
        font-weight: 500;
        margin-bottom: 4px;
        display: block;
        color: #444;
    }

    .required {
        color: #e74c3c;
    }

    .register-form input {
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 18px;
        border: 2px solid transparent;
        border-radius: 15px;
        font-size: 1rem;
        outline: none;
        background: linear-gradient(white, white) padding-box,
            linear-gradient(to right, #3ad36b, #3A85D3) border-box;
        box-shadow: none;
        transition: box-shadow 0.3s ease, border 0.3s ease;
    }

    .register-form input:focus {
        box-shadow: 0 0 0 2px rgba(58, 133, 211, 0.2);
    }

    .register-btn {
        width: 100%;
        background: #3A85D3;
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 20px;
        padding: 12px 0;
        font-size: 1rem;
        margin-top: 10px;
        box-shadow: 0 4px 12px rgba(58, 133, 211, 0.10);
        transition: background 0.2s;
    }

    .register-btn:hover {
        background: #296bb0;
    }

    .register-footer {
        margin-top: 18px;
        font-size: 0.95rem;
        color: #222;
    }

    .register-footer a {
        color: #3A85D3;
        text-decoration: none;
        font-weight: 500;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }

    .toggle-password {
        position: absolute;
        transform: translateY(-50%);
        top: 50%;
        right: 20px;
        cursor: pointer;
        color: #888;
        font-size: 1rem;
        z-index: 10;
    }

    input[type="password"] {
        padding-right: 40px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.95em;
        margin-top: -18px;
        margin-bottom: 18px;
        text-align: left;
    }

    input[type="email"]::-webkit-validation-bubble,
    input[type="text"]::-webkit-validation-bubble,
    input[type="password"]::-webkit-validation-bubble,
    input[type="email"]::-webkit-input-decoration,
    input[type="text"]::-webkit-input-decoration,
    input[type="password"]::-webkit-input-decoration {
        display: none !important;
    }

    input[type="email"]:invalid,
    input[type="text"]:invalid,
    input[type="password"]:invalid {
        box-shadow: none;
    }

    input[type="password"]::-ms-reveal,
    input[type="password"]::-webkit-clear-button,
    input[type="password"]::-webkit-input-decoration,
    input[type="password"]::-webkit-credentials-auto-fill-button,
    input[type="password"]::-webkit-inner-spin-button,
    input[type="password"]::-webkit-outer-spin-button {
        display: none !important;
    }
</style>

<?= $this->endSection() ?>