<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NewArticle extends Migration
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
            'lastVersion' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'       => false,
                
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('newarticle');
    }

    public function down()
    {
        $this->forge->dropTable('newarticle');
    }
}


