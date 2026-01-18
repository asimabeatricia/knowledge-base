<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewManualSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 'manual-001',
                'slug'        => 'jamsostek-mobile',
                'jam'         => '24 Jam',
                'jamDukungan'   => 'Senin - Jumat, 08.00 - 17.00 WIB',
                'target'      => '99.5% per bulan',
                'penyedia'    => 'Divisi TI BPJS Ketenagakerjaan',
                'keterkaitan' => 'Sistem Informasi Kepesertaan, Sistem Klaim, API Gateway',
                'deskripsi'   => 'Aplikasi mobile untuk layanan informasi BPJS Ketenagakerjaan bagi peserta.',
                'unit'        => 'Direktorat Pelayanan',
                'layanan'     => 'Aplikasi Jamsostek Mobile',
                'komponen'    => 'Mobile App, API Gateway, Database Server, Push Notification',
                'lastVersion' => 'v1.2.3',
            ],
        ];
        $this->db->table('newmanual')->insertBatch($data);
    }
}
