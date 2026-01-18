<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'       => 'EPS',
                'description' => 'Aplikasi EPS untuk layanan digital',
                'icon_url'    => '/assets/icons/eps.png'
            ],
            // Tambah data lain sesuai kebutuhan
        ];

        // Masukkan ke tabel 'pages'
        $this->db->table('pages')->insertBatch($data);
    }
}
