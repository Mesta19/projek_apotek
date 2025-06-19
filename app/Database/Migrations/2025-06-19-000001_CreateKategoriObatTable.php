<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriObatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori_obat');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_obat');
    }
}