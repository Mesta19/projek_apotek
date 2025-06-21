<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_transaksi' => 1, 'tanggal_transaksi' => '2025-05-21 00:00:00', 'total_harga' => 70000.00, 'id_user' => 1],
            ['id_transaksi' => 2, 'tanggal_transaksi' => '2025-05-21 00:00:00', 'total_harga' => 80000.00, 'id_user' => 1],
            ['id_transaksi' => 3, 'tanggal_transaksi' => '2025-05-21 00:00:00', 'total_harga' => 270000.00, 'id_user' => 1],
            ['id_transaksi' => 4, 'tanggal_transaksi' => '2025-05-21 00:00:00', 'total_harga' => 80000.00, 'id_user' => 2],
            ['id_transaksi' => 5, 'tanggal_transaksi' => '2025-05-22 00:00:00', 'total_harga' => 20000.00, 'id_user' => 1],
            ['id_transaksi' => 6, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 20000.00, 'id_user' => 1],
            ['id_transaksi' => 7, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 60000.00, 'id_user' => 1],
            ['id_transaksi' => 8, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 20000.00, 'id_user' => 1],
            ['id_transaksi' => 9, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 20000.00, 'id_user' => 1],
            ['id_transaksi' => 10, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 10000.00, 'id_user' => 1],
            ['id_transaksi' => 11, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 30000.00, 'id_user' => 1],
            ['id_transaksi' => 12, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 120000.00, 'id_user' => 1],
            ['id_transaksi' => 13, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 220000.00, 'id_user' => 1],
            ['id_transaksi' => 14, 'tanggal_transaksi' => '2025-05-23 00:00:00', 'total_harga' => 110000.00, 'id_user' => 1],
            ['id_transaksi' => 15, 'tanggal_transaksi' => '2025-05-23 17:50:05', 'total_harga' => 110000.00, 'id_user' => 1],
            ['id_transaksi' => 16, 'tanggal_transaksi' => '2025-05-23 17:51:21', 'total_harga' => 190000.00, 'id_user' => 1],
            ['id_transaksi' => 17, 'tanggal_transaksi' => '2025-05-23 17:52:28', 'total_harga' => 10000.00, 'id_user' => 1],
            ['id_transaksi' => 18, 'tanggal_transaksi' => '2025-05-23 17:54:17', 'total_harga' => 10000.00, 'id_user' => 1],
            ['id_transaksi' => 19, 'tanggal_transaksi' => '2025-05-23 17:55:12', 'total_harga' => 10000.00, 'id_user' => 1],
            ['id_transaksi' => 20, 'tanggal_transaksi' => '2025-05-23 17:55:41', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 21, 'tanggal_transaksi' => '2025-05-23 19:34:12', 'total_harga' => 620000.00, 'id_user' => 1],
            ['id_transaksi' => 22, 'tanggal_transaksi' => '2025-05-23 19:35:46', 'total_harga' => 60000.00, 'id_user' => 2],
            ['id_transaksi' => 23, 'tanggal_transaksi' => '2025-05-26 13:08:09', 'total_harga' => 60000.00, 'id_user' => 1],
            ['id_transaksi' => 24, 'tanggal_transaksi' => '2025-05-26 13:18:42', 'total_harga' => 110000.00, 'id_user' => 2],
            ['id_transaksi' => 25, 'tanggal_transaksi' => '2025-06-02 11:36:30', 'total_harga' => 70000.00, 'id_user' => 1],
            ['id_transaksi' => 26, 'tanggal_transaksi' => '2025-06-11 13:31:00', 'total_harga' => 2000.00, 'id_user' => 1],
            ['id_transaksi' => 27, 'tanggal_transaksi' => '2025-06-11 13:33:18', 'total_harga' => 20000.00, 'id_user' => 1],
            ['id_transaksi' => 28, 'tanggal_transaksi' => '2025-06-11 14:03:19', 'total_harga' => 20000.00, 'id_user' => 1],
            ['id_transaksi' => 29, 'tanggal_transaksi' => '2025-06-11 14:26:33', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 30, 'tanggal_transaksi' => '2025-06-11 14:37:55', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 31, 'tanggal_transaksi' => '2025-06-11 14:39:08', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 32, 'tanggal_transaksi' => '2025-06-11 14:41:21', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 33, 'tanggal_transaksi' => '2025-06-11 14:43:41', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 34, 'tanggal_transaksi' => '2025-06-11 14:44:43', 'total_harga' => 50000.00, 'id_user' => 1],
            ['id_transaksi' => 35, 'tanggal_transaksi' => '2025-06-18 13:57:15', 'total_harga' => 160000.00, 'id_user' => 1],
            ['id_transaksi' => 36, 'tanggal_transaksi' => '2025-06-18 14:22:10', 'total_harga' => 160000.00, 'id_user' => 2],
        ];
        $this->db->table('transaksi')->insertBatch($data);
    }
}
