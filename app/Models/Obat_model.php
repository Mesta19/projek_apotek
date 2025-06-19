<?php

namespace App\Models;

use CodeIgniter\Model;

class Obat_model extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['nama_obat', 'id_kategori', 'barcode', 'deskripsi', 'harga', 'stok', 'satuan', 'gambar'];

    public function getObat($id = false, $kategoriId = false)
    {
        // 1. Buat dasar query builder agar tidak berulang
        $builder = $this->db->table($this->table)
            ->select('obat.*, kategori_obat.nama_kategori')
            ->join('kategori_obat', 'kategori_obat.id_kategori = obat.id_kategori', 'left');

        // 2. Jika ada ID spesifik, cari satu obat (untuk halaman edit/detail)
        if ($id !== false) {
            return $builder->where('obat.id_obat', $id)->get()->getRowArray();
        }

        // 3. JIKA ADA FILTER KATEGORI, tambahkan kondisi 'where'
        if ($kategoriId !== false && !empty($kategoriId)) {
            $builder->where('obat.id_kategori', $kategoriId);
        }

        // 4. Kembalikan semua hasil (sudah terfilter jika ada kategoriId)
        return $builder->get()->getResultArray();
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
