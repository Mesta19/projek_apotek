<?php

namespace App\Controllers;

use App\Models\Transaksi_model;
use App\Models\Laporan_model;

class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Menu Laporan',
            'navbar' => 'Laporan'
        ];

        return view('laporan/index', $data);
    }

    public function penjualan()
{
    $model = new \App\Models\Transaksi_model();
    $session = session();

    // 1. Ambil tanggal dari URL
    $tanggalAwal = $this->request->getGet('tanggal_awal');
    $tanggalAkhir = $this->request->getGet('tanggal_akhir');

    // 2. [INI BAGIAN PENTING] Ambil dan siapkan parameter urutan
    // Baris ini mengambil 'urutan' dari URL (misal: 'asc' atau 'desc')
    $urutan = $this->request->getGet('urutan');
    // ...lalu baris ini membuat variabel $sortOrder. Inilah yang hilang/salah di kode Anda.
    $sortOrder = ($urutan === 'asc') ? 'ASC' : 'DESC'; 

    // 3. Buat variabel baru untuk query, yang akan dimodifikasi
    $tanggalAkhirForQuery = $tanggalAkhir;

    // 4. Tambahkan waktu 23:59:59 ke tanggal akhir JIKA ada nilainya
    if ($tanggalAkhirForQuery) {
        $tanggalAkhirForQuery .= ' 23:59:59';
    }

    // 5. Panggil model dengan menyertakan parameter urutan ($sortOrder)
    // Variabel $sortOrder kemudian digunakan di sini saat memanggil model.
    $laporan = $model->getLaporan($tanggalAwal, $tanggalAkhirForQuery, $sortOrder);

    $data = [
        'title' => 'Laporan Penjualan',
        'navbar' => 'Laporan',
        'level' => $session->get('level'),
        'laporan' => $laporan,
        'tanggal_awal' => $tanggalAwal,
        'tanggal_akhir' => $tanggalAkhir
    ];

    return view('laporan/penjualan', $data);
}

    // Salin dan ganti seluruh fungsi ini di Laporan.php
public function pendapatan()
{
    $model = new Laporan_model();

    // Menggunakan getGet() karena kita beralih ke method GET
    $tanggalAwal = $this->request->getGet('tanggal_awal');
    $tanggalAkhir = $this->request->getGet('tanggal_akhir');

    // Menyiapkan variabel tanggal untuk query
    $tanggalAkhirForQuery = $tanggalAkhir;
    if ($tanggalAkhirForQuery) {
        $tanggalAkhirForQuery .= ' 23:59:59';
    }

    // Mengambil data pendapatan berdasarkan filter (jika ada)
    $pendapatan = null;
    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
        $pendapatan = $model->getPendapatan($tanggalAwal, $tanggalAkhirForQuery);
    }

    // Tetap mengambil total seluruh pendapatan
    $totalSeluruhPendapatan = $model->getTotalPendapatan();

    // --- MULAI KODE BARU ---
    // Query untuk mendapatkan rincian stok obat terjual berdasarkan filter tanggal
    $db = \Config\Database::connect();
    $builder = $db->table('detail_transaksi');
    $builder->select('obat.nama_obat, SUM(detail_transaksi.jumlah) as total_terjual');
    $builder->join('obat', 'obat.id_obat = detail_transaksi.id_obat'); // Pastikan nama kolom (id_obat) sudah benar
    $builder->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi'); // Pastikan nama kolom sudah benar

    $stok_terjual = []; // Inisialisasi sebagai array kosong
    if (!empty($tanggalAwal) && !empty($tanggalAkhirForQuery)) {
        $builder->where('transaksi.tanggal_transaksi >=', $tanggalAwal);
        $builder->where('transaksi.tanggal_transaksi <=', $tanggalAkhirForQuery);
        
        $builder->groupBy('obat.nama_obat');
        $builder->orderBy('total_terjual', 'DESC'); // Urutkan dari yang paling banyak terjual

        $stok_terjual = $builder->get()->getResultArray();
    }
    // --- SELESAI KODE BARU ---

    $data = [
        'title' => 'Laporan Pendapatan',
        'navbar' => 'Laporan',
        'pendapatan' => $pendapatan,
        'totalSeluruhPendapatan' => $totalSeluruhPendapatan,
        'stok_terjual' => $stok_terjual, // <-- DATA BARU DITAMBAHKAN DI SINI
        'tanggal_awal' => $tanggalAwal,
        'tanggal_akhir' => $tanggalAkhir,
    ];

    return view('laporan/pendapatan', $data);
}

    public function hapusTransaksi($id_transaksi)
    {
        $session = session();
        // Cek role user, ganti sesuai nama key role di session kamu
        if ($session->get('level') !== 'Developer') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus transaksi.');
        }

        $model = new \App\Models\Transaksi_model();

        // Cek transaksi ada atau tidak
        $transaksi = $model->find($id_transaksi);
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Hapus transaksi dan detail transaksi (jika ada relasi)
        $db = \Config\Database::connect();
        $db->transStart();

        // Hapus detail transaksi dulu
        $db->table('detail_transaksi')->where('id_transaksi', $id_transaksi)->delete();

        // Hapus transaksi
        $model->delete($id_transaksi);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.');
        }

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

    public function hapusSemuaTransaksi()
    {
        $session = session();
        if ($session->get('level') !== 'Developer') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus transaksi.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Hapus semua detail transaksi dulu
        $db->table('detail_transaksi')->truncate();

        // Hapus semua transaksi
        $db->table('transaksi')->truncate();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menghapus semua transaksi.');
        }

        return redirect()->back()->with('success', 'Semua transaksi berhasil dihapus.');
    }

    public function hapusSemuaPendapatan()
    {
        $session = session();
        if ($session->get('level') !== 'Developer') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin...');
        }

        $db = \Config\Database::connect();
        try {
            $db->transStart();
            $db->query('SET FOREIGN_KEY_CHECKS = 0;');
            $db->table('detail_transaksi')->truncate();
            $db->table('transaksi')->truncate();
            $db->query('SET FOREIGN_KEY_CHECKS = 1;');
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi gagal.');
            }

            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}
