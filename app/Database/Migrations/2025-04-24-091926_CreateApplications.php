<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplications extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'name'          => [
                'type' => 'VARCHAR', 
                'constraint' => '255'
            ],
            'description'   => [
                'type' => 'TEXT', 
                'null' => true
            ],
            'manual_link'   => [
                'type' => 'VARCHAR', 
                'constraint' => '255'
            ],
            'created_at'    => [
                'type' => 'DATETIME', 
                'null' => true
            ],
            'updated_at'    => [
                'type' => 'DATETIME', 
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('applications');
    }

    public function down()
    {
        $this->forge->dropTable('applications');
    }
}
