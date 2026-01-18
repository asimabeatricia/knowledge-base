<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryWhatsnewTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'whatsnew_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'action'         => ['type' => 'VARCHAR', 'constraint' => 50],
            'changed_by'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'changed_at'     => ['type' => 'DATETIME'],
            'old_data'       => ['type' => 'TEXT', 'null' => true],
            'new_data'       => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('history_whatsnew');
    }

    public function down()
    {
        $this->forge->dropTable('history_whatsnew');
    }
}
