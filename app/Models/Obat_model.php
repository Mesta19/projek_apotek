<?php

namespace App\Models;

use CodeIgniter\Model;

class Obat_model extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['nama_obat', 'id_kategori', 'barcode', 'deskripsi', 'harga', 'stok', 'satuan', 'gambar'];

    public function getObat($id = false)
    {
        if ($id === false) {
            return $this->db->table('obat')
                ->select('obat.*, kategori_obat.nama_kategori')
                ->join('kategori_obat', 'kategori_obat.id_kategori = obat.id_kategori')
                ->get()
                ->getResultArray();
        }

        return $this->db->table('obat')
            ->select('obat.*, kategori_obat.nama_kategori')
            ->join('kategori_obat', 'kategori_obat.id_kategori = obat.id_kategori')
            ->where('obat.id_obat', $id)
            ->get()
            ->getRowArray();
    }

    public function insertObat($data)
    {
        return $this->insert($data);
    }

    public function searchObat($keyword)
    {
        return $this->like('nama_obat', $keyword)
            ->orLike('deskripsi', $keyword)
            ->orWhereIn('id_kategori', function ($builder) use ($keyword) {
                return $builder->select('id_kategori')
                    ->from('kategori_obat')
                    ->like('nama_kategori', $keyword);
            })
            ->findAll();
    }

    public function updateObat($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteObat($id)
    {
        return $this->delete($id);
    }

    public function getKategoriObat()
    {
        $kategoriModel = new Kategori_obat_model();
        return $kategoriModel->findAll();
    }

    // Fungsi baru untuk cari obat berdasarkan barcode
    public function getByBarcode(string $barcode)
    {
        return $this->where('barcode', $barcode)->first();
    }
}
