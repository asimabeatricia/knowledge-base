<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkToArticlesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('articles', [
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'category', 
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('articles', 'link');
    }
}
