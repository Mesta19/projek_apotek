<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriObatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_kategori' => 3, 'nama_kategori' => 'AntiSakit'],
            ['id_kategori' => 5, 'nama_kategori' => 'Antibiotik'],
            ['id_kategori' => 6, 'nama_kategori' => 'Obat Kulit'],
            ['id_kategori' => 7, 'nama_kategori' => 'Vitamin'],
            ['id_kategori' => 8, 'nama_kategori' => 'Suplemen'],
            ['id_kategori' => 11, 'nama_kategori' => 'Obat Ringan'],
            ['id_kategori' => 13, 'nama_kategori' => 'Obat Keras'],
            ['id_kategori' => 14, 'nama_kategori' => 'Antiseptik'],
        ];

        // Using Query Builder
        $this->db->table('kategori_obat')->insertBatch($data);
    }
}