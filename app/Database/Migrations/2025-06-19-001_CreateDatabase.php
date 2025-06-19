<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDatabase extends Migration
{
    public function up()
    {
        $forge = \Config\Database::forge();
        $forge->createDatabase('db_apotek', true);
    }

    public function down()
    {
        $forge = \Config\Database::forge();
        $forge->dropDatabase('db_apotek');
    }
}
