<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap">
</head>

<body>
    <div class="forgot-container">
        <div class="forgot-logo">
            <img src="/img/logoWarna.png" alt="BPJS Ketenagakerjaan" width="170">
        </div>
        <div class="forgot-title">Lupa Password?</div>
        <div class="forgot-desc">
            Masukkan email Anda dan kami akan mengirimkan instruksi untuk reset password Anda
        </div>
        <form class="forgot-form" action="<?= site_url('forgot'); ?>" method="post">
            <?= csrf_field() ?>
            <input type="email" name="email" placeholder="Masukkan email Anda"
                class="form-control input-gradient <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                value="<?= old('email') ?>" autofocus>
            <?php if (session('errors.email')): ?>
                <div class="invalid-feedback" style="display:block;">
                    <?= session('errors.email') ?>
                </div>
            <?php endif; ?>
            <button type="submit">Kirim</button>
        </form>
    </div>
</body>

<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap');

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        font-family: 'Poppins', Arial, sans-serif;
    }

    body {
        min-height: 100vh;
        min-width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .forgot-container {
        max-width: 430px;
        width: 100%;
        background: #fff;
        text-align: center;
        padding: 32px 24px;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(90, 144, 194, 0.04);
        font-family: 'Poppins', Arial, sans-serif;
    }

    .forgot-logo {
        margin-bottom: 18px;
    }

    .forgot-title {
        color: #5A90C2;
        font-size: 2.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .forgot-desc {
        color: #6B6B6B;
        font-size: 1.08rem;
        margin-bottom: 28px;
    }

    .forgot-form input[type="email"] {
        width: 100%;
        padding: 16px;
        font-size: 1rem;
        margin-bottom: 28px;
        outline: none;
        transition: border 0.2s;
        box-sizing: border-box;
        border: 2px solid transparent;
        border-radius: 15px;
        background-image: linear-gradient(white, white), linear-gradient(to right, #1E90FF, #32CD32);
        background-origin: border-box;
        background-clip: padding-box, border-box;
    }

    .forgot-form input[type="email"]:focus {
        box-shadow: 0 0 0 2px rgba(58, 133, 211, 0.2);
    }

    .forgot-form button {
        width: 100%;
        padding: 15px;
        background: #5A90C2;
        color: #fff;
        font-size: 1.15rem;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(90, 144, 194, 0.08);
        cursor: pointer;
        transition: background 0.2s;
    }

    .forgot-form button:hover {
        background: #357ABD;
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

    @media (max-width: 600px) {
        .forgot-container {
            max-width: 95vw;
            padding: 24px 8px;
        }

        .forgot-title {
            font-size: 1.5rem;
        }
    }
</style>

</html>