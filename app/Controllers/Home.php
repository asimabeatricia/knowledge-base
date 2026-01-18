<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $isLoggedIn = service('authentication')->check();
        $manual = [
            ['id' => 1, 'slug' => 'jamsostek-mobile', 'judul' => 'Jamsostek Mobile', 'kategori' => 'Aplikasi Eksternal', 'icon' => 'jamsostek.png'],
            ['id' => 2, 'slug' => 'eps', 'judul' => 'EPS', 'kategori' => 'Aplikasi Eksternal', 'icon' => 'eps.png'],
            ['id' => 3, 'slug' => 'e-grade', 'judul' => 'E-Grade', 'kategori' => 'Aplikasi Internal', 'icon' => 'e-grade.png'],
        ];

        $icon = [
            1 => '/img/jamsostek.png',
            2 => '/img/eps.png',
            3 => '/img/e-grade.png',
        ];

        $data = [
            'title' => 'Home | Knowledge Base',
            'manual' => $manual,
            'icon' => $icon,
            'isLoggedIn' => $isLoggedIn,
        ];

        return view('home', $data);
    }
}
