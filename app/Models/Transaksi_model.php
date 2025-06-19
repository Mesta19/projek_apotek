<?php

namespace App\Models;
use CodeIgniter\Model;

class Transaksi_model extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'tanggal_transaksi',
        'total_harga',
        'id_user'
    ];

    public function getAll()
    {
        return $this->orderBy('id_transaksi', 'DESC')->findAll();
    }

    public function getById($id)
    {
        return $this->where('id_transaksi', $id)->first();
    }

    // --- KODE LAMA ANDA ---
    // public function getLaporan($tanggalAwal = null, $tanggalAkhir = null)
    // { ... }

    // --- GANTI DENGAN KODE BARU DI BAWAH INI ---
    public function getLaporan($tanggalAwal = null, $tanggalAkhir = null, $sortOrder = 'DESC')
    {
        $builder = $this->db->table('transaksi t')
            ->select('
                t.id_transaksi,
                t.tanggal_transaksi,
                t.total_harga,
                t.id_user,
                u.nama_lengkap,
                d.id_obat,
                o.nama_obat,
                d.jumlah,
                d.harga_satuan,
                d.subtotal
            ')
            ->join('detail_transaksi d', 'd.id_transaksi = t.id_transaksi')
            // Menggunakan 'users' sesuai dengan kode asli Anda
            ->join('users u', 'u.id_user = t.id_user')
            ->join('obat o', 'o.id_obat = d.id_obat');

        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            $builder->where('t.tanggal_transaksi >=', $tanggalAwal)
                    ->where('t.tanggal_transaksi <=', $tanggalAkhir);
        }

        // [PERUBAHAN] Mengganti orderBy yang tetap dengan yang dinamis dari controller
        $builder->orderBy('t.tanggal_transaksi', $sortOrder);
        $builder->orderBy('t.id_transaksi', $sortOrder);

        return $builder->get()->getResultArray();
    }
}