<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_manual_id'   => ['type' => 'INT', 'constraint' => 11],
            'action'           => ['type' => 'VARCHAR', 'constraint' => '50'],
            'editor'           => ['type' => 'VARCHAR', 'constraint' => '100'],
            'content_before'   => ['type' => 'TEXT', 'null' => true],
            'content_after'    => ['type' => 'TEXT', 'null' => true],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('history');
    }

    public function down()
    {
        $this->forge->dropTable('history');
    }
}
