<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key check
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $this->db->table('detail_transaksi')->truncate();
        $this->db->table('transaksi')->truncate();
        $this->db->table('obat')->truncate();
        $this->db->table('kategori_obat')->truncate();
        $this->db->table('users')->truncate();
        // Aktifkan kembali foreign key check
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        // Seed data sesuai urutan relasi
        $this->call('KategoriObatSeeder');
        $this->call('ObatSeeder');
        $this->call('UserSeeder');
        $this->call('TransaksiSeeder');
        $this->call('DetailTransaksiSeeder');
    }
}