<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablesFromSql extends Migration
{
    public function up()
    {
        // users
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'level' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users');

        // kategori_obat
        $this->forge->addField([
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori_obat');

        // obat
        $this->forge->addField([
            'id_obat' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_obat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'barcode' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'stok' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_obat', true);
        $this->forge->addUniqueKey('barcode');
        $this->forge->addKey('id_kategori');
        $this->forge->addForeignKey('id_kategori', 'kategori_obat', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->createTable('obat');

        // transaksi
        $this->forge->addField([
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal_transaksi' => [
                'type' => 'DATETIME',
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addKey('id_user');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaksi');

        // detail_transaksi
        $this->forge->addField([
            'id_detail' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_obat' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga_satuan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->addKey('id_transaksi');
        $this->forge->addKey('id_obat');
        $this->forge->addForeignKey('id_transaksi', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_obat', 'obat', 'id_obat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi');
        $this->forge->dropTable('transaksi');
        $this->forge->dropTable('obat');
        $this->forge->dropTable('kategori_obat');
        $this->forge->dropTable('users');
    }
}
