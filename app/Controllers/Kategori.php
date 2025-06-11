<?php

namespace App\Controllers;

use App\Models\Kategori_obat_model;
use Config\Services;

class Kategori extends BaseController
{
    protected $kategoriModel;
    protected $validation; // Tambahkan properti untuk validasi
    protected $session;    // Tambahkan properti untuk session

    public function __construct()
    {
        $this->kategoriModel = new Kategori_obat_model();
        $this->validation = \Config\Services::validation(); // Inisialisasi validasi
        $this->session = Services::session();            // Inisialisasi session
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Kategori Obat',
            'navbar' => 'Kategori',
            'kategori' => $this->kategoriModel->getKategori()
        ];

        return view('kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori Obat',
            'navbar' => 'Kategori',
            'validation' => $this->validation // Tambahkan ini agar view dapat mengakses objek validasi
        ];

        return view('kategori/create', $data);
    }

    public function save()
    {
        // Definisikan aturan validasi
        $validationRules = [
            'nama_kategori' => 'required|is_unique[kategori_obat.nama_kategori]', // Contoh: nama_kategori harus unik
        ];

        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, simpan error ke session dan redirect ke form create
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/kategori/create')->withInput(); // withInput() agar data yang sudah diisi tidak hilang
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];

        $this->kategoriModel->insertKategori($data);
        $this->session->setFlashdata('pesan', 'Data kategori obat berhasil ditambahkan.');
        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kategori Obat',
            'navbar' => 'Kategori',
            'kategori' => $this->kategoriModel->getKategori($id),
            'validation' => $this->validation // Tambahkan ini agar view dapat mengakses objek validasi
        ];

        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        // Definisikan aturan validasi.  Gunakan 'ignore_unique' untuk mengabaikan duplikasi untuk record yang sedang diupdate
        $validationRules = [
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori_obat.nama_kategori,kategori_obat.id,{id}]',
                'errors' => [
                    'is_unique' => 'Nama kategori sudah digunakan.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, simpan error ke session dan redirect ke form edit
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/kategori/edit/' . $id)->withInput();
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];

        $this->kategoriModel->updateKategori($id, $data);
        $this->session->setFlashdata('pesan', 'Data kategori obat berhasil diubah.');
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->kategoriModel->deleteKategori($id);
        $this->session->setFlashdata('pesan', 'Data kategori obat berhasil dihapus.');
        return redirect()->to('/kategori');
    }
}
