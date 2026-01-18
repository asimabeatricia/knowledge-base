<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => false,
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'user',
                'after'      => 'password_hash',
            ],
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'reset_at' => [
                'type' => 'DATETIME',
                'null'       => false,
            ],
            'reset_expires' => [
                'type' => 'DATETIME',
                'null'       => false,
            ],
            'activate_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'status_message' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,  
            ],
            'active' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'null'       => false,
            ],
            'force_pass_reset' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null'       => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null'       => false,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropColumn('users','role');
    }
}
