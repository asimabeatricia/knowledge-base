<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'EPS',
                'description' => 'Aplikasi Presensi Kehadiran',
                'manual_link' => 'http://localhost/manual/index.php/EPS',
            ],
            [
                'name'        => 'e-Procurement',
                'description' => 'Aplikasi Pengadaan Barang & Jasa',
                'manual_link' => 'http://localhost/manual/index.php/EProcurement',
            ],
        ];

        $this->db->table('applications')->insertBatch($data);
    }
}
