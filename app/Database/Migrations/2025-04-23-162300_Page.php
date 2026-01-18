<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Page extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'       => false,
                
            ],
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'       => false,
            ],
            'content' => [
                'type'           => 'TEXT',
                'null'       => false,
            ],
            'icon' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'       => false,
            ],
            'is_published' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 0,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'           => 'DATETIME',
                'null'       => true,
            ],
            'created_by' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'       => true,
            ],
            'updated_by' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'       => true,
            ],
            'versioning' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 1,
            ],
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pages');
    }

    public function down()
    {
        $this->forge->dropTable('pages');
    }
}
