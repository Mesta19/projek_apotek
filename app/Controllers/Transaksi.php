<?php

namespace App\Controllers;

use App\Models\Obat_model;
use App\Models\Transaksi_model;
use App\Models\Detail_transaksi_model;
use CodeIgniter\Controller;
date_default_timezone_set('Asia/Jakarta');

class Transaksi extends BaseController
{
    protected $obatModel;
    protected $transaksiModel;
    protected $detailTransaksiModel;
    protected $session;

    public function __construct()
    {
        $this->obatModel = new Obat_model();
        $this->transaksiModel = new Transaksi_model();
        $this->detailTransaksiModel = new Detail_transaksi_model();
        $this->session = session();
        $this->db = \Config\Database::connect(); 
    }

    public function index()
    {
        $keranjang = $this->session->get('keranjang') ?? [];
        return view('transaksi/index', [
            'title' => 'Transaksi Kasir',
            'navbar' => 'Transaksi',
            'keranjang' => $keranjang
        ]);
    }

    public function scanBarcode()
{
    $barcode = $this->request->getPost('barcode');
    $obat = $this->obatModel->where('barcode', $barcode)->first();

    if ($obat) {
        $keranjang = $this->session->get('keranjang') ?? [];

        $id_obat = $obat['id_obat'];

        if (isset($keranjang[$id_obat])) {
            $keranjang[$id_obat]['jumlah'] += 1;
            $keranjang[$id_obat]['subtotal'] = $keranjang[$id_obat]['jumlah'] * $obat['harga'];
        } else {
            $keranjang[$id_obat] = [
                'nama_obat' => $obat['nama_obat'],
                'harga' => $obat['harga'],
                'jumlah' => 1,
                'subtotal' => $obat['harga']
            ];
        }

        $this->session->set('keranjang', $keranjang);
    }

    if ($this->request->isAJAX()) {
        return $this->response->setJSON(['status' => 'success']);
    }

    return redirect()->to('/transaksi');
}


public function proses()
{
    $keranjang = $this->session->get('keranjang') ?? [];
    if (empty($keranjang)) {
        return redirect()->to('/transaksi')->with('error', 'Keranjang kosong!');
    }

    $total = array_sum(array_column($keranjang, 'subtotal'));
    $bayar = $this->request->getPost('bayar');

    if ($bayar < $total) {
        return redirect()->to('/transaksi')->with('error', 'Uang pembayaran kurang!');
    }

    $kembalian = $bayar - $total;

    // Mulai transaksi database
    $this->db->transBegin();

    // 1. Simpan data transaksi
    $this->transaksiModel->insert([
        'tanggal_transaksi' => date('Y-m-d H:i:s'),
        'total_harga' => $total,
        // 'uang_bayar' => $bayar, // Tidak perlu disimpan ke DB
        // 'uang_kembali' => $kembalian, // Tidak perlu disimpan ke DB
        'id_user' => session('id_user')
    ]);

    $id_transaksi = $this->transaksiModel->insertID();

    $berhasil_kurangi_stok = true;
    $detail_struk = [];
    // 2. Simpan detail transaksi dan kurangi stok obat
    foreach ($keranjang as $id_obat => $item) {
        $obatModel = new \App\Models\Obat_model(); // Instantiate ObatModel di dalam loop
        $obat = $obatModel->find($id_obat);
        if ($obat) {
            if ($obat['stok'] >= $item['jumlah']) {
                $this->detailTransaksiModel->insert([
                    'id_transaksi' => $id_transaksi,
                    'id_obat' => $id_obat,
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['subtotal']
                ]);

                // Tambahkan detail untuk struk
                $detail_struk[] = [
                    'nama_obat' => $item['nama_obat'],
                    'harga' => $item['harga'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal']
                ];

                // 3. Kurangi stok obat
                $obatModel->update($id_obat, ['stok' => $obat['stok'] - $item['jumlah']]);
            } else {
                $this->session->setFlashdata('error', 'Stok ' . $item['nama_obat'] . ' tidak mencukupi untuk transaksi ini. Transaksi dibatalkan.');
                $berhasil_kurangi_stok = false;
                break; // Hentikan loop dan rollback transaksi
            }
        } else {
            $this->session->setFlashdata('error', 'Obat dengan ID ' . $id_obat . ' tidak ditemukan. Transaksi dibatalkan.');
            $berhasil_kurangi_stok = false;
            break; // Hentikan loop dan rollback transaksi
        }
    }

    // 4. Commit atau Rollback transaksi
    if ($this->db->transStatus() === false || !$berhasil_kurangi_stok) {
        $this->db->transRollback();
        return redirect()->to('/transaksi')->withInput();
    } else {
        $this->db->transCommit();
        $this->session->remove('keranjang');

        // Simpan bayar dan kembali ke session
        $this->session->set('bayar_temp', $bayar);
        $this->session->set('kembali_temp', $kembalian);

        // Kirim respons sukses dengan ID transaksi
        return $this->response->setJSON(['success' => true, 'id_transaksi' => $id_transaksi]);
    }
}

public function tampilkanStruk($id_transaksi)
{
    $transaksi = $this->transaksiModel->find($id_transaksi);
    $detailTransaksi = $this->detailTransaksiModel->getByIdTransaksi($id_transaksi); // Gunakan method yang sudah di-join

    if (!$transaksi) {
        return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
    }

    $dataStruk = [
        'nomor_transaksi' => $transaksi['id_transaksi'],
        'tanggal_transaksi' => date('d-m-Y H:i:s', strtotime($transaksi['tanggal_transaksi'])),
        'total' => $transaksi['total_harga'],
        'bayar' => $this->session->get('bayar_temp'),
        'kembalian' => $this->session->get('kembali_temp'),
        'detail_transaksi' => $detailTransaksi, // $detailTransaksi sekarang sudah berisi nama_obat
        'nama_toko' => 'Apotek Sehat Selalu'
    ];

    $this->session->remove('bayar_temp');
    $this->session->remove('kembali_temp');

    return view('transaksi/struk', $dataStruk);
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

public function updateJumlah()
{
    $id_obat = $this->request->getPost('id_obat');
    $jumlah_baru = (int) $this->request->getPost('jumlah');

    if ($jumlah_baru < 1) {
        return redirect()->to('/transaksi')->with('error', 'Jumlah minimal 1');
    }

    $obat = $this->obatModel->find($id_obat);

    if ($obat) {
        if ($jumlah_baru > $obat['stok']) {
            return redirect()->to('/transaksi')->with('error', 'Stok ' . $obat['nama_obat'] . ' tidak mencukupi. Stok tersedia: ' . $obat['stok']);
        } else {
            $keranjang = $this->session->get('keranjang') ?? [];
            if (isset($keranjang[$id_obat])) {
                $keranjang[$id_obat]['jumlah'] = $jumlah_baru;
                $keranjang[$id_obat]['subtotal'] = $jumlah_baru * $keranjang[$id_obat]['harga'];
                $this->session->set('keranjang', $keranjang);
            }
        }
    } else {
        return redirect()->to('/transaksi')->with('error', 'Obat tidak ditemukan.');
    }

    return redirect()->to('/transaksi');
}

public function hapusItem()
{
    $id_obat = $this->request->getPost('id_obat'); // AMBIL dari POST

    $keranjang = $this->session->get('keranjang') ?? [];

    if (isset($keranjang[$id_obat])) {
        unset($keranjang[$id_obat]);
        $this->session->set('keranjang', $keranjang);
    }

    return redirect()->to('/transaksi');
}



}
