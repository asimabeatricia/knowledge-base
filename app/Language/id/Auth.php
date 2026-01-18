<?php

return [
    // Exceptions
    'invalidModel'        => 'Model {0} harus dimuat sebelum digunakan.',
    'userNotFound'        => 'Tidak dapat menemukan pengguna dengan ID = {0, number}.',
    'noUserEntity'        => 'Entity Pengguna harus disediakan untuk validasi kata sandi.',
    'tooManyCredentials'  => 'Hanya boleh memvalidasi satu kredensial selain kata sandi.',
    'invalidFields'       => 'Kolom "{0}" tidak dapat digunakan untuk memvalidasi kredensial.',
    'unsetPasswordLength' => 'Anda harus mengatur `minimumPasswordLength` di file konfigurasi Auth.',
    'unknownError'        => 'Maaf, terjadi masalah saat mengirim email kepada Anda. Silakan coba lagi nanti.',
    'notLoggedIn'         => 'Anda harus masuk untuk mengakses halaman tersebut.',
    'notEnoughPrivilege'  => 'Anda tidak memiliki izin yang cukup untuk mengakses halaman tersebut.',

    // Registration
    'registerDisabled' => 'Maaf, pendaftaran pengguna baru tidak diperbolehkan saat ini.',
    'registerSuccess'  => 'Selamat datang! Silakan masuk dengan kredensial baru Anda.',
    'registerCLI'      => 'Pengguna baru dibuat: {0}, #{1}',

    // Activation
    'activationNoUser'       => 'Tidak dapat menemukan pengguna dengan kode aktivasi tersebut.',
    'activationSubject'      => 'Aktifkan akun Anda',
    'activationSuccess'      => 'Silakan konfirmasi akun Anda dengan mengklik tautan aktivasi di email yang telah kami kirim.',
    'activationResend'       => 'Kirim ulang pesan aktivasi sekali lagi.',
    'notActivated'           => 'Akun pengguna ini belum diaktifkan.',
    'errorSendingActivation' => 'Gagal mengirim pesan aktivasi ke: {0}',

    // Login
    'badAttempt'      => 'Gagal masuk. Silakan periksa kredensial Anda.',
    'loginSuccess'    => 'Selamat datang kembali!',
    'invalidPassword' => 'Gagal masuk. Silakan periksa kata sandi Anda.',

    // Forgotten Passwords
    'forgotDisabled'  => 'Fitur pengaturan ulang kata sandi telah dinonaktifkan.',
    'forgotNoUser'    => 'Tidak dapat menemukan pengguna dengan email tersebut.',
    'forgotSubject'   => 'Instruksi Pengaturan Ulang Kata Sandi',
    'resetSuccess'    => 'Kata sandi Anda berhasil diubah. Silakan masuk dengan kata sandi baru.',
    'forgotEmailSent' => 'Token keamanan telah dikirim ke email Anda. Masukkan token tersebut di kolom di bawah untuk melanjutkan.',
    'errorEmailSent'  => 'Gagal mengirim email dengan instruksi pengaturan ulang kata sandi ke: {0}',
    'errorResetting'  => 'Gagal mengirim instruksi pengaturan ulang ke: {0}',

    // Passwords
    'errorPasswordLength'         => 'Kata sandi harus terdiri dari minimal {0, number} karakter.',
    'suggestPasswordLength'       => 'Frasa sandi - hingga 255 karakter - lebih aman dan mudah diingat.',
    'errorPasswordCommon'         => 'Kata sandi tidak boleh kata sandi umum.',
    'suggestPasswordCommon'       => 'Kata sandi telah diperiksa terhadap lebih dari 65 ribu kata sandi umum atau bocoran.',
    'errorPasswordPersonal'       => 'Kata sandi tidak boleh berisi informasi pribadi yang diproses ulang.',
    'suggestPasswordPersonal'     => 'Jangan gunakan variasi alamat email atau nama pengguna sebagai kata sandi.',
    'errorPasswordTooSimilar'     => 'Kata sandi terlalu mirip dengan nama pengguna.',
    'suggestPasswordTooSimilar'   => 'Jangan gunakan bagian dari nama pengguna Anda di dalam kata sandi.',
    'errorPasswordPwned'          => 'Kata sandi {0} telah bocor dalam insiden keamanan dan ditemukan sebanyak {1, number} kali dalam {2} database.',
    'suggestPasswordPwned'        => 'Jangan pernah gunakan {0} sebagai kata sandi. Segera ganti jika Anda menggunakannya di tempat lain.',
    'errorPasswordPwnedDatabase'  => 'sebuah database',
    'errorPasswordPwnedDatabases' => 'beberapa database',
    'errorPasswordEmpty'          => 'Kata sandi wajib diisi.',
    'passwordChangeSuccess'       => 'Kata sandi berhasil diubah.',
    'userDoesNotExist'            => 'Kata sandi tidak diubah. Pengguna tidak ditemukan.',
    'resetTokenExpired'           => 'Maaf. Token reset Anda telah kedaluwarsa.',

    // Groups
    'groupNotFound' => 'Grup tidak ditemukan: {0}.',

    // Permissions
    'permissionNotFound' => 'Izin tidak ditemukan: {0}',

    // Banned
    'userIsBanned' => 'Pengguna telah diblokir. Hubungi administrator.',

    // Too many requests
    'tooManyRequests' => 'Terlalu banyak permintaan. Silakan tunggu {0, number} detik.',

    // Login views
    'home'                      => 'Beranda',
    'current'                   => 'Saat ini',
    'forgotPassword'            => 'Lupa Kata Sandi?',
    'enterEmailForInstructions' => 'Tidak masalah! Masukkan email Anda dan kami akan mengirimkan instruksi untuk mereset kata sandi.',
    'email'                     => 'Email',
    'emailAddress'              => 'Alamat Email',
    'sendInstructions'          => 'Kirim Instruksi',
    'loginTitle'                => 'Masuk',
    'loginAction'               => 'Masuk',
    'rememberMe'                => 'Ingat saya',
    'needAnAccount'             => 'Belum punya akun?',
    'forgotYourPassword'        => 'Lupa kata sandi?',
    'password'                  => 'Kata Sandi',
    'repeatPassword'            => 'Ulangi Kata Sandi',
    'emailOrUsername'           => 'Email atau Nama Pengguna',
    'username'                  => 'Nama Pengguna',
    'register'                  => 'Daftar',
    'signIn'                    => 'Masuk',
    'alreadyRegistered'         => 'Sudah terdaftar?',
    'weNeverShare'              => 'Kami tidak akan pernah membagikan email Anda kepada siapa pun.',
    'resetYourPassword'         => 'Reset Kata Sandi Anda',
    'enterCodeEmailPassword'    => 'Masukkan kode dari email Anda, alamat email Anda, dan kata sandi baru.',
    'token'                     => 'Token',
    'newPassword'               => 'Kata Sandi Baru',
    'newPasswordRepeat'         => 'Ulangi Kata Sandi Baru',
    'resetPassword'             => 'Atur Ulang Kata Sandi',
];
