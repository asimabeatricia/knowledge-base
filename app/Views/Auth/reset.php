<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="reset-container">
        <div class="reset-logo">
            <img src="/img/logoWarna.png" alt="BPJS Ketenagakerjaan" width="170">
        </div>
        <div class="reset-title">
            <span class="blue"> Reset Password</span>
        </div>
        <form action="<?= site_url('reset-password'); ?>" method="post" autocomplete="off">
            <?= csrf_field() ?>

            <label class="reset-label" for="token">Token</label>
            <input class="reset-input <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" type="text" id="token" name="token" placeholder="Masukkan Token" value="<?= old('token') ?>">
            <?php if (session('errors.token')): ?>
                <div class="invalid-feedback">
                    <?= session('errors.token') ?>
                </div>
            <?php endif; ?>

            <label class="reset-label" for="email">Email</label>
            <input class="reset-input <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" type="email" id="email" name="email" placeholder="Masukkan email Anda" value="<?= old('email') ?>">
            <?php if (session('errors.email')): ?>
                <div class="invalid-feedback" style="display:block;">
                    <?= session('errors.email') ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label class="reset-label" for="password">Password Baru</label>
                <div class="input-wrapper">
                    <input class="reset-input <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" type="password" id="password" name="password" placeholder="Masukkan password baru">
                    <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
                </div>
                <?php if (session('errors.password')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                <?php endif; ?>
            </div>

            <label class="reset-label" for="pass_confirm">Konfirmasi Password Baru</label>
            <div class="input-wrapper">
                <input class="reset-input <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" type="password" id="pass_confirm" name="pass_confirm" placeholder="Masukkan password kembali">
                <i class="fa-solid fa-eye toggle-password" id="toggleConfirmPassword"></i>
                <?php if (session('errors.pass_confirm')): ?>
                    <div class="invalid-feedback" style="display:block;">
                        <?= session('errors.pass_confirm') ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="reset-btn">Reset Password</button>
        </form>
    </div>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Poppins', Arial, sans-serif;
            background: #fff;
        }

        body {
            min-height: 100vh;
            min-width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-container {
            width: 100%;
            max-width: 410px;
            background: #fff;
            border-radius: 20px;
            padding: 36px 28px 32px 28px;
            box-sizing: border-box;
            text-align: center;
        }

        .reset-logo {
            margin-bottom: 18px;
        }

        .reset-title {
            font-size: 2rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }

        .reset-title .blue {
            color: #4A90E2;
        }

        .reset-label {
            display: block;
            text-align: left;
            margin-bottom: 6px;
            margin-top: 18px;
            color: #444;
            font-size: 1rem;
            font-weight: 500;
        }

        .reset-input,
        .reset-btn {
            width: 100%;
            box-sizing: border-box;
            border-radius: 20px;
        }

        .reset-input {
            width: 100%;
            padding: 13px 16px;
            margin-bottom: 2px;
            border: 2px solid transparent;
            border-radius: 15px;
            font-size: 1rem;
            outline: none;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(to right, #3ad36b, #3A85D3) border-box;
            font-family: 'Poppins', Arial, sans-serif;
            transition: box-shadow 0.3s ease, border 0.3s ease;
            box-shadow: none;
        }

        .reset-input:focus {
            box-shadow: 0 0 0 2px rgba(58, 133, 211, 0.2);
        }

        .reset-btn {
            padding: 15px;
            background: #4A90E2;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            margin-top: 23px;
            box-shadow: 0 4px 12px rgba(90, 144, 194, 0.08);
            cursor: pointer;
            transition: background 0.2s;
            box-sizing: border-box;
        }

        .reset-btn:hover {
            background: #357ABD;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i.toggle-password {
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: 1rem;
        }

        .reset-input[type="password"] {
            padding-right: 45px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.95em;
            margin-top: 2px;
            margin-bottom: 5px;
            text-align: left;
            padding-left: 2px;
        }

        @media (max-width: 600px) {
            .reset-container {
                max-width: 95vw;
                padding: 18px 4vw;
            }

            .reset-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('pass_confirm');
            const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
            confirmPasswordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>