<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToNewmanual extends Migration
{
    public function up()
    {
        $this->forge->addColumn('newmanual', [
            'jamDukungan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'target' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'penyedia' => [
                'type'           => 'VARCHAR',
                'constraint'     => 150,
                'null'           => true,
            ],
            'keterkaitan' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'deskripsi' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'unit' => [
                'type'           => 'VARCHAR',
                'constraint'     => 150,
                'null'           => true,
            ],
            'layanan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 150,
                'null'           => true,
            ],
            'komponen' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('newmanual', [
            'jamDukung',
            'target',
            'penyedia',
            'keterkaitan',
            'deskripsi',
            'unit',
            'layanan',
            'komponen',
        ]);
    }
}
