<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewArticle extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'editor' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'versioning' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'content' => [
                'type'       => 'LONGTEXT',      
                'null'       => false,  
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'DATE',      
                'null'       => false,  
            ],
            'updated_at' => [
                'type'       => 'DATE',      
                'null'       => false,  
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'description' => [
                'type'       => 'LONGTEXT',      
                'null'       => false,  
            ],
           'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'published' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }
}
