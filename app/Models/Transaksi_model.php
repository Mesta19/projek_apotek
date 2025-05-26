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

    public function getLaporan($tanggalAwal = null, $tanggalAkhir = null)
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
        ->join('users u', 'u.id_user = t.id_user')
        ->join('obat o', 'o.id_obat = d.id_obat'); // Tambahkan join ke tabel obat

    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
        $builder->where('t.tanggal_transaksi >=', $tanggalAwal)
                ->where('t.tanggal_transaksi <=', $tanggalAkhir);
    }

    // Urutkan berdasarkan id_transaksi agar detail obat per transaksi berdekatan
    return $builder->orderBy('t.id_transaksi', 'ASC')
                   ->get()
                   ->getResultArray();
}
}