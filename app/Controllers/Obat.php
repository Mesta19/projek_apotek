<?php

namespace App\Controllers;

use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\Obat_model; 
use Config\Services;
use App\Models\Kategori_obat_model;

class Obat extends BaseController
{
    protected $obatModel;
    protected $kategoriModel;
    protected $validation;
    protected $session; // Declare the session property

    public function __construct()
    {
        $this->obatModel = new \App\Models\Obat_model();
        $this->kategoriModel = new \App\Models\Kategori_obat_model(); // Inisialisasi KategoriModel
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }
    

    public function index()
    {
        $data = [
            'title' => 'Daftar Obat',
            'navbar' => 'Obat',
            'obat' => $this->obatModel->getObat()
        ];

        return view('obat/index', $data);
    }

    public function create()
{
    // Generate barcode
    $barcode = 'OBAT-' . rand(1000, 9999);
    $generator = new BarcodeGeneratorPNG();
    $barcodeBinary = $generator->getBarcode($barcode, $generator::TYPE_CODE_128);

    // Simpan file PNG
    $barcodePath = FCPATH . 'barcodes/' . $barcode . '.png';
    file_put_contents($barcodePath, $barcodeBinary);

    // Encode base64 untuk preview di form
    $barcodeBase64 = base64_encode($barcodeBinary);

    return view('obat/create', [
        'barcode' => $barcode,
        'navbar' => 'Obat',
        'barcodeImage' => $barcodeBase64,
        'validation' => \Config\Services::validation(),
        'kategori' => $this->kategoriModel->getKategori()
    ]);
}


public function save()
{
    $validationRules = [
        'nama_obat' => 'required',
        'id_kategori' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
        'barcode' => 'required' // tambahkan validasi
    ];

    if (!$this->validate($validationRules)) {
        $this->session->setFlashdata('errors', $this->validation->getErrors());
        return redirect()->to('/obat/create')->withInput();
    }

    // Upload gambar
    $fileGambar = $this->request->getFile('gambar');
    $namaGambar = $fileGambar->getRandomName();
    $fileGambar->move('uploads', $namaGambar);

    $barcode = $this->request->getPost('barcode');

    $data = [
        'nama_obat' => $this->request->getPost('nama_obat'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'harga' => $this->request->getPost('harga'),
        'stok' => $this->request->getPost('stok'),
        'satuan' => $this->request->getPost('satuan'),
        'gambar' => $namaGambar,
        'barcode' => $barcode
    ];

    $this->obatModel->insertObat($data);
    $this->session->setFlashdata('pesan', 'Data obat berhasil ditambahkan.');
    return redirect()->to('/obat');
}



// Contoh fungsi buat convert PNG ke JPG dan kirim sebagai download
public function downloadBarcode($id)
{
    $obat = $this->obatModel->getObat($id);

    if (!$obat || empty($obat['barcode'])) {
        return redirect()->back()->with('error', 'Barcode tidak ditemukan.');
    }

    $barcodeFilename = $obat['barcode'] . '.png';
    $barcodePath = FCPATH . 'barcodes/' . $barcodeFilename;

    if (!file_exists($barcodePath)) {
        return redirect()->back()->with('error', 'File barcode tidak ditemukan.');
    }

    return $this->response->download($barcodePath, null)
        ->setFileName($barcodeFilename)
        ->setContentType('image/png');
}




public function updateBarcode($id)
{
    if (!$this->request->isAJAX() || !$this->request->getMethod() === 'post') {
        return redirect()->to('/obat');
    }

    $model = new \App\Models\Obat_model();

    // Generate kode barcode baru
    $newBarcode = uniqid('OBAT-');

    // Generate barcode image
    $generator = new BarcodeGeneratorPNG();
    $barcodeImage = $generator->getBarcode($newBarcode, $generator::TYPE_CODE_128);

    // Simpan file barcode ke folder barcodes/
    $barcodeDir = FCPATH . 'barcodes/';

if (!is_dir($barcodeDir)) {
    mkdir($barcodeDir, 0755, true);
}

$barcodeFileName = $newBarcode . '.png';
file_put_contents($barcodeDir . $barcodeFileName, $barcodeImage);



    // Update di database (hanya simpan kode barcode)
    $updateData = ['barcode' => $newBarcode];
    $updated = $model->update($id, $updateData);

    if ($updated) {
        return $this->response->setJSON(['success' => true, 'barcode' => $newBarcode]);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal update database']);
    }
}




    public function edit($id)
    {
        $obat = $this->obatModel->find($id);
        $data = [
            'title' => 'Edit Obat',
            'navbar' => 'Obat',
            'obat' => $this->obatModel->getObat($id),
            'kategori' => $this->obatModel->getKategoriObat(),
            'validation' => $this->validation
        ];

        return view('obat/edit', $data);
    }

    public function cari()
    {
        $keyword = $this->request->getPost('keyword');
        $data = [
            'title' => 'Hasil Pencarian Obat',
            'obat' => $this->obatModel->searchObat($keyword),
            'keyword' => $keyword
        ];
        return view('obat/cari', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'nama_obat' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg]'  // Ubah ukuran ke 1024KB (1MB)
        ];

        if (!$this->validate($validationRules)) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/obat/edit/' . $id)->withInput();
        }

        $data = [
            'nama_obat' => $this->request->getPost('nama_obat'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'satuan' => $this->request->getPost('satuan')
        ];

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads', $namaGambar);
            $obatLama = $this->obatModel->getObat($id);
            if ($obatLama['gambar'] != null) {
                unlink('uploads/' . $obatLama['gambar']);
            }
            $data['gambar'] = $namaGambar;
        } else {
            $data['gambar'] = $this->request->getPost('gambar_lama');
        }

        $this->obatModel->updateObat($id, $data);
        $this->session->setFlashdata('pesan', 'Data obat berhasil diubah.');
        return redirect()->to('/obat');
    }

    public function delete($id)
    {
        $obat = $this->obatModel->getObat($id);
        if ($obat['gambar'] != null) {
            unlink('uploads/' . $obat['gambar']);
        }

        $this->obatModel->deleteObat($id);
        $this->session->setFlashdata('pesan', 'Data obat berhasil dihapus.');
        return redirect()->to('/obat');
    }

    public function ajaxCariBarcode()
{
    $request = service('request');
    $isAjax = $request->isAJAX();

    $input = $this->request->getJSON();
    $barcode = $input->barcode ?? null;

    if (!$barcode) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Barcode tidak dikirim.'
        ]);
    }

    $obat = $this->obatModel->where('barcode', $barcode)->first();

    if (!$obat) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Obat dengan barcode tersebut tidak ditemukan.'
        ]);
    }

    $session = session();
    $keranjang = $session->get('keranjang') ?? [];

    $id = $obat['id_obat'];

    if (isset($keranjang[$id])) {
        $keranjang[$id]['jumlah'] += 1;
        $keranjang[$id]['subtotal'] = $keranjang[$id]['jumlah'] * $keranjang[$id]['harga'];
    } else {
        $keranjang[$id] = [
            'id_obat' => $obat['id_obat'],
            'nama_obat' => $obat['nama_obat'],
            'harga' => $obat['harga'],
            'jumlah' => 1,
            'subtotal' => $obat['harga']
        ];
    }

    $session->set('keranjang', $keranjang);

    return $this->response->setJSON([
        'success' => true,
        'data' => $obat
    ]);
}


public function scan($id_obat)
{
    $obat = $this->obatModel->find($id_obat);
    if (!$obat) {
        return redirect()->back()->with('error', 'Obat tidak ditemukan.');
    }

    $session = session();
    $keranjang = $session->get('keranjang') ?? [];

    if (isset($keranjang[$id_obat])) {
        $keranjang[$id_obat]['jumlah'] += 1;
    } else {
        $keranjang[$id_obat] = [
            'id' => $obat['id'],
            'nama' => $obat['nama_obat'],
            'harga' => $obat['harga'],
            'jumlah' => 1
        ];
    }

    $session->set('keranjang', $keranjang);
    return redirect()->to('/obat/keranjang');
}
public function keranjang()
{
    $keranjang = session()->get('keranjang') ?? [];
    $total = 0;

    foreach ($keranjang as $item) {
        $total += $item['harga'] * $item['jumlah'];
    }

    return view('obat/keranjang', [
        'keranjang' => $keranjang,
        'total' => $total
    ]);
}

public function clearKeranjang()
{
    session()->remove('keranjang');

    // Cek apakah request AJAX
    if ($this->request->isAJAX()) {
        return $this->response->setJSON(['success' => true]);
    }

    // Jika bukan AJAX, redirect biasa
    return redirect()->to(base_url('transaksi'))->with('success', 'Keranjang dikosongkan.');
}


public function proses()
{
    $keranjang = session()->get('keranjang') ?? [];
    $total = 0;

    foreach ($keranjang as $item) {
        $total += $item['harga'] * $item['jumlah'];
    }

    $bayar = (int) $this->request->getPost('bayar');
    $kembalian = $bayar - $total;

    if ($kembalian < 0) {
        return redirect()->back()->with('error', 'Uang tidak cukup.');
    }

    // Simpan hasil transaksi ke flashdata
    session()->setFlashdata('transaksi_selesai', [
        'keranjang' => $keranjang,
        'total' => $total,
        'bayar' => $bayar,
        'kembalian' => $kembalian
    ]);

    // Kosongkan keranjang
    session()->remove('keranjang');

    return redirect()->to(base_url('transaksi'));
}



}
