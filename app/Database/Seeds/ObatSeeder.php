<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_obat' => 15, 'nama_obat' => 'Obat Coding', 'barcode' => 'OBAT-7287', 'id_kategori' => 3, 'deskripsi' => 'Coding Semalam anti ngantuk', 'harga' => 10000.00, 'stok' => 72, 'satuan' => 'Tablet', 'gambar' => '1750298199_eaaf5205a5f1a9a8a9b7.jpg'],
            ['id_obat' => 16, 'nama_obat' => 'Betadine', 'barcode' => 'OBAT-2029', 'id_kategori' => 6, 'deskripsi' => 'Untuk luka terjatuh, lecet pada kulit, atasi infeksi pada kulit', 'harga' => 50000.00, 'stok' => 20, 'satuan' => 'Botol', 'gambar' => '1747664927_a63228bfb5a04f8fbd5b.jpeg'],
            ['id_obat' => 17, 'nama_obat' => 'Krill Oil Antarctic', 'barcode' => 'OBAT-9651', 'id_kategori' => 7, 'deskripsi' => 'Terbuat dari minyak Krill. Vitamin untuk kesehatan.', 'harga' => 110000.00, 'stok' => 76, 'satuan' => 'Softgel', 'gambar' => '1747664990_bab1b8fa96058e242c57.jpeg'],
            ['id_obat' => 19, 'nama_obat' => 'Koyo Hansaplast', 'barcode' => 'OBAT-8358', 'id_kategori' => 3, 'deskripsi' => 'Atasi rasa pegal. Cukup tempel koyo ke bagian tubuh yang pegal. Rasa panas akan hilangkan pegal.', 'harga' => 20000.00, 'stok' => 985, 'satuan' => 'Tempel', 'gambar' => '1747723373_4cf874be84971a643cfb.jpeg'],
            ['id_obat' => 20, 'nama_obat' => 'Hau Fung San', 'barcode' => 'OBAT-5782', 'id_kategori' => 11, 'deskripsi' => 'Untuk hilangkan sariawan di mulut. cukup tabur pada area sariawan. Dijamin sembuh', 'harga' => 10000.00, 'stok' => 971, 'satuan' => 'Bubuk', 'gambar' => '1747801092_cc1934b535f803ee7ed0.jpg'],
            ['id_obat' => 21, 'nama_obat' => 'Bodrex', 'barcode' => 'OBAT-8683', 'id_kategori' => 11, 'deskripsi' => 'Untuk atasi Sakit kepala, migrain, dan kepala pusing berlebihan.', 'harga' => 10000.00, 'stok' => 974, 'satuan' => 'Tablet', 'gambar' => '1747841336_e4bcf9c497881a6074e3.jpg'],
            ['id_obat' => 22, 'nama_obat' => 'Komix', 'barcode' => 'OBAT-9900', 'id_kategori' => 11, 'deskripsi' => 'Obat untuk batuk ringan. ', 'harga' => 2000.00, 'stok' => 999, 'satuan' => 'Sirup', 'gambar' => '1750261884_f68feaac754e40662f3c.jpeg'],
        ];
        $this->db->table('obat')->insertBatch($data);
    }
}
