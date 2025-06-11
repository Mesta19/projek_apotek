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

        $tanggalAwal = $this->request->getGet('tanggal_awal');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');
        $session = session();
        $data = [
            'title' => 'Laporan Penjualan',
            'navbar' => 'Laporan',
            'level'=>$session->get('level'),
            'laporan' => $model->getLaporan($tanggalAwal, $tanggalAkhir),
        ];

        return view('laporan/penjualan', $data);
    }

    public function pendapatan()
    {
        $model = new Laporan_model();

        $tanggalAwal = $this->request->getPost('tanggal_awal');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');

        $pendapatan = $model->getPendapatan($tanggalAwal, $tanggalAkhir);
        $totalSeluruhPendapatan = $model->getTotalPendapatan(); // Ambil total seluruh pendapatan

        $data = [
            'title' => 'Laporan Pendapatan',
            'navbar'=>'Laporan',
            'pendapatan' => $pendapatan,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
            'totalSeluruhPendapatan' => $totalSeluruhPendapatan, // Kirim ke view
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