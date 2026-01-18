<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WhatsNew extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'       => false,
                
            ],
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('whatsnew');
    }

    public function down()
    {
        $this->forge->dropTable('whatsnew');
    }
}


