<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddManualContentToPages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pages', [
            'manual_content' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'icon'  
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pages', 'manual_content');
    }
}
