<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder lain dalam urutan yang benar
        $this->call('KategoriObatSeeder');
        $this->call('UsersSeeder');
        // Panggil seeder obat dan transaksi jika Anda membuatnya
    }
}