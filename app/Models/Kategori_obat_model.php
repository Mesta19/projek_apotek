<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori_obat_model extends Model
{
    protected $table = 'kategori_obat';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nama_kategori'];

    public function getKategori($id = false)
    {
        if ($id === false) {
            return $this->findAll(); // Mengambil semua data kategori
        }

        return $this->where(['id_kategori' => $id])->first(); // Mengambil data kategori berdasarkan ID
    }

    public function insertKategori($data)
    {
        return $this->insert($data); // Menambahkan data kategori baru
    }

    public function updateKategori($id, $data)
    {
        return $this->update($id, $data); // Memperbarui data kategori
    }

    public function deleteKategori($id)
    {
        return $this->delete($id); // Menghapus data kategori
    }
}
