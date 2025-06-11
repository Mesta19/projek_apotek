<?php

namespace App\Models;
use CodeIgniter\Model;

class Detail_transaksi_model extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = [
        'id_transaksi',
        'id_obat',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];

    public function insertDetail($data)
    {
        return $this->insertBatch($data);
    }

    public function getByIdTransaksi($id_transaksi)
{
    return $this->where('id_transaksi', $id_transaksi)
                ->join('obat', 'obat.id_obat = detail_transaksi.id_obat')
                ->select('detail_transaksi.*, obat.nama_obat, obat.harga')
                ->findAll();
}

    
    public function obat()
    {
        return $this->belongsTo('App\Models\Obat_model', 'id_obat');
    }
}