<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryToPages extends Migration
{
    public function up()
    {
        $forge = \Config\Database::forge();

    $fields = [
        'category' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
            'null'       => true,
            'after'      => 'title' // atau kolom mana pun yang kamu mau
        ],
    ];

    $forge->addColumn('pages', $fields);
    }

    public function down()
    {
        $forge = \Config\Database::forge();
        $forge->dropColumn('pages', 'category');
    }
}
