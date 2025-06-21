<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user' => 1,
                'username' => 'developer',
                'password' => '$2y$10$2wDvVC87/IR2DPlGgIrJ8udi8OQAsKat.g8/wfaA83nxJPnL1Z/rS',
                'level' => 'Developer',
                'nama_lengkap' => 'Developer Account'
            ],
            [
                'id_user' => 2,
                'username' => 'Kasir1',
                'password' => '$2y$12$K75W05XP1MRoztIrZDoWl.uOMGOurGK3mKX99Cu52H1VsUmVn/mqS',
                'level' => 'kasir',
                'nama_lengkap' => 'Kasir Apotik'
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
