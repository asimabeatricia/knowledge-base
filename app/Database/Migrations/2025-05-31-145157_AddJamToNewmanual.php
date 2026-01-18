<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJamToNewmanual extends Migration
{
    public function up()
    {
        $fields = [
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'slug'
            ],
        ];

        $this->forge->addColumn('newmanual', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('newmanual', 'jam');
    }
}
