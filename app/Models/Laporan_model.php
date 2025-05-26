<?php namespace App\Models;

use CodeIgniter\Model;

class Laporan_model extends Model
{
    protected $table = 'transaksi';

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
            d.jumlah, 
            d.harga_satuan, 
            d.subtotal
        ')
        ->join('detail_transaksi d', 'd.id_transaksi = t.id_transaksi')
        ->join('user u', 'u.id_user = t.id_user'); // Tambahkan join ke tabel user

    if ($tanggalAwal && $tanggalAkhir) {
        $builder->where('t.tanggal_transaksi >=', $tanggalAwal)
                ->where('t.tanggal_transaksi <=', $tanggalAkhir);
    }

    $builder->orderBy('t.tanggal_transaksi', 'DESC');

    return $builder->get()->getResultArray();
}

public function getPendapatan($tanggalAwal = null, $tanggalAkhir = null)
    {
        $builder = $this->db->table($this->table);

        if ($tanggalAwal && $tanggalAkhir) {
            $builder->where('tanggal_transaksi >=', $tanggalAwal)
                    ->where('tanggal_transaksi <=', $tanggalAkhir);
        }

        $builder->selectSum('total_harga', 'total_pendapatan');

        return $builder->get()->getRowArray();
    }

public function getTotalPendapatan($tanggalAwal = null, $tanggalAkhir = null)
{
    $builder = $this->db->table('transaksi');

    if ($tanggalAwal && $tanggalAkhir) {
        $builder->where('tanggal_transaksi >=', $tanggalAwal)
                ->where('tanggal_transaksi <=', $tanggalAkhir);
    }

    $builder->selectSum('total_harga', 'total_pendapatan');

    return $builder->get()->getRowArray();
}

public function hapusTransaksiById($id_transaksi)
{
    // Hapus detail transaksi dulu
    $this->db->table('detail_transaksi')->where('id_transaksi', $id_transaksi)->delete();
    // Hapus transaksi
    $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->delete();
}

public function hapusSemuaTransaksi()
{
    // Hapus semua detail transaksi dulu
    $this->db->table('detail_transaksi')->delete();
    // Hapus semua transaksi
    $this->db->table('transaksi')->delete();
}
}
