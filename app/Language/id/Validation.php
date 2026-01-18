<?php

return [
    'required'      => 'Kolom {field} harus diisi.',
    'min_length'    => 'Kolom {field} minimal harus terdiri dari {param} karakter.',
    'max_length'    => 'Kolom {field} tidak boleh lebih dari {param} karakter.',
    'valid_email'   => 'Silakan masukkan alamat email yang valid.',
    'alpha_numeric_space' => 'Kolom {field} hanya boleh berisi huruf, angka, dan spasi.',
    'username' => [
        'alpha_numeric_space' => 'Kolom nama pengguna hanya boleh berisi huruf, angka, dan spasi.',
        'min_length'          => 'Nama pengguna minimal harus terdiri dari 3 karakter.',
        'max_length'          => 'Nama pengguna tidak boleh lebih dari 30 karakter.',
    ],
    'email' => [
        'valid_email' => 'Silakan masukkan alamat email yang valid.',
        'max_length'  => 'Alamat email tidak boleh lebih dari 254 karakter.',
    ],
    'password' => [
        'min_length' => 'Kata sandi minimal harus terdiri dari 8 karakter.',
        'max_length' => 'Kata sandi tidak boleh lebih dari 255 karakter.',
    ],
    'attributes' => [
        'login' => 'username',
        'password' => 'password',
    ],
];
