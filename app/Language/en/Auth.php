<?php

namespace Myth\Auth\Language\id;

return [
    // Exceptions
    'invalidModel'        => 'Model {0} harus dimuat sebelum digunakan.',
    'userNotFound'        => 'Tidak dapat menemukan pengguna dengan ID = {0, number}.',
    'noUserEntity'        => 'Entity pengguna harus disediakan untuk validasi kata sandi.',
    'tooManyCredentials'  => 'Hanya boleh memvalidasi terhadap satu kredensial selain kata sandi.',
    'invalidFields'       => 'Field "{0}" tidak dapat digunakan untuk validasi kredensial.',
    'unsetPasswordLength' => 'Anda harus mengatur `minimumPasswordLength` dalam file konfigurasi Auth.',
    'unknownError'        => 'Maaf, terjadi masalah saat mengirim email kepada Anda. Silakan coba lagi nanti.',
    'notLoggedIn'         => 'Anda harus login untuk mengakses halaman tersebut.',
    'notEnoughPrivilege'  => 'Anda tidak memiliki izin yang cukup untuk mengakses halaman tersebut.',

    // Registrasi
    'registerDisabled' => 'Maaf, pendaftaran pengguna baru tidak diperbolehkan saat ini.',
    'registerSuccess'  => 'Selamat datang! Silakan login dengan kredensial baru Anda.',
    'registerCLI'      => 'Pengguna baru dibuat: {0}, #{1}',

    // Aktivasi
    'activationNoUser'       => 'Tidak dapat menemukan pengguna dengan kode aktivasi tersebut.',
    'activationSubject'      => 'Aktifkan akun Anda',
    'activationSuccess'      => 'Silakan konfirmasi akun Anda dengan mengklik tautan aktivasi di email yang telah kami kirim.',
    'activationResend'       => 'Kirim ulang pesan aktivasi sekali lagi.',
    'notActivated'           => 'Akun pengguna ini belum diaktifkan.',
    'errorSendingActivation' => 'Gagal mengirim pesan aktivasi ke: {0}',

    // Login
    'badAttempt'      => 'Tidak dapat login. Periksa kembali kredensial Anda.',
    'loginSuccess'    => 'Selamat datang kembali!',
    'invalidPassword' => 'Tidak dapat login. Periksa kembali kata sandi Anda.',

    // Lupa Kata Sandi
    'forgotDisabled'  => 'Fitur reset kata sandi telah dinonaktifkan.',
    'forgotNoUser'    => 'Tidak dapat menemukan pengguna dengan email tersebut.',
    'forgotSubject'   => 'Instruksi Reset Kata Sandi',
    'resetSuccess'    => 'Kata sandi Anda berhasil diubah. Silakan login dengan kata sandi baru.',
    'forgotEmailSent' => 'Token keamanan telah dikirim ke email Anda. Masukkan di kotak di bawah ini untuk melanjutkan.',
    'errorEmailSent'  => 'Tidak dapat mengirim email berisi instruksi reset kata sandi ke: {0}',
    'errorResetting'  => 'Tidak dapat mengirim instruksi reset ke {0}',

    // Kata Sandi
    'errorPasswordLength'         => 'Kata sandi harus memiliki panjang minimal {0, number} karakter.',
    'suggestPasswordLength'       => 'Frasa sandi - hingga 255 karakter - lebih aman dan mudah diingat.',
    'errorPasswordCommon'         => 'Kata sandi tidak boleh merupakan kata sandi umum.',
    'suggestPasswordCommon'       => 'Kata sandi ini telah dibandingkan dengan lebih dari 65 ribu kata sandi umum atau yang bocor.',
    'errorPasswordPersonal'       => 'Kata sandi tidak boleh mengandung informasi pribadi.',
    'suggestPasswordPersonal'     => 'Jangan gunakan variasi dari alamat email atau nama pengguna Anda sebagai kata sandi.',
    'errorPasswordTooSimilar'     => 'Kata sandi terlalu mirip dengan nama pengguna.',
    'suggestPasswordTooSimilar'   => 'Jangan gunakan bagian dari nama pengguna dalam kata sandi.',
    'errorPasswordPwned'          => 'Kata sandi {0} telah bocor dalam pelanggaran data dan telah terlihat {1, number} kali dalam {2} database yang bocor.',
    'suggestPasswordPwned'        => '{0} sebaiknya tidak digunakan sebagai kata sandi. Jika Anda menggunakannya, segera ganti.',
    'errorPasswordPwnedDatabase'  => 'satu database',
    'errorPasswordPwnedDatabases' => 'beberapa database',
    'errorPasswordEmpty'          => 'Kata sandi wajib diisi.',
    'passwordChangeSuccess'       => 'Kata sandi berhasil diubah.',
    'userDoesNotExist'            => 'Kata sandi tidak diubah. Pengguna tidak ditemukan.',
    'resetTokenExpired'           => 'Maaf. Token reset Anda telah kedaluwarsa.',

    // Grup
    'groupNotFound' => 'Tidak dapat menemukan grup: {0}.',

    // Izin
    'permissionNotFound' => 'Tidak dapat menemukan izin: {0}',

    // Diblokir
    'userIsBanned' => 'Pengguna ini telah diblokir. Hubungi administrator.',

    // Terlalu Banyak Permintaan
    'tooManyRequests' => 'Terlalu banyak permintaan. Silakan tunggu {0, number} detik.',

    // Tampilan Login
    'home'                      => 'Beranda',
    'current'                   => 'Saat ini',
    'forgotPassword'            => 'Lupa Kata Sandi Anda?',
    'enterEmailForInstructions' => 'Tidak masalah! Masukkan email Anda di bawah ini dan kami akan kirimkan instruksi untuk mereset kata sandi.',
    'email'                     => 'Email',
    'emailAddress'              => 'Alamat Email',
    'sendInstructions'          => 'Kirim Instruksi',
    'loginTitle'                => 'Masuk',
    'loginAction'               => 'Masuk',
    'rememberMe'                => 'Ingat saya',
    'needAnAccount'             => 'Belum punya akun?',
    'forgotYourPassword'        => 'Lupa kata sandi Anda?',
    'password'                  => 'Kata Sandi',
    'repeatPassword'            => 'Ulangi Kata Sandi',
    'emailOrUsername'           => 'Email atau nama pengguna',
    'username'                  => 'Nama Pengguna',
    'register'                  => 'Daftar',
    'signIn'                    => 'Masuk',
    'alreadyRegistered'         => 'Sudah punya akun?',
    'weNeverShare'              => 'Kami tidak akan pernah membagikan email Anda ke siapa pun.',
    'resetYourPassword'         => 'Atur Ulang Kata Sandi Anda',
    'enterCodeEmailPassword'    => 'Masukkan kode yang Anda terima melalui email, alamat email Anda, dan kata sandi baru.',
    'token'                     => 'Token',
    'newPassword'               => 'Kata Sandi Baru',
    'newPasswordRepeat'         => 'Ulangi Kata Sandi Baru',
    'resetPassword'             => 'Atur Ulang Kata Sandi',
];
