<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::dashboard', ['filter' => 'auth']);

// Routes untuk Controller Obat
$routes->get('/obat', 'Obat::index', ['filter' => 'auth']);
$routes->get('/obat/create', 'Obat::create', ['filter' => 'auth']);
$routes->post('/obat/save', 'Obat::save',['filter' => 'auth']);
$routes->get('/obat/edit/(:num)', 'Obat::edit/$1',['filter' => 'auth']);
$routes->post('/obat/update/(:num)', 'Obat::update/$1',['filter' => 'auth']);
$routes->get('/obat/delete/(:num)', 'Obat::delete/$1',['filter' => 'auth']);
$routes->post('/obat/cari', 'Obat::cari', ['filter' => 'auth']);
$routes->get('obat/downloadBarcode/(:segment)', 'Obat::downloadBarcode/$1');
$routes->get('/obat/downloadBarcode/(:num)', 'Obat::downloadBarcode/$1');
$routes->post('obat/updateBarcode/(:num)', 'Obat::updateBarcode/$1');
$routes->post('/obat/ajaxCariBarcode', 'Obat::ajaxCariBarcode');



// Routes untuk Controller Kategori
$routes->get('/kategori', 'Kategori::index',['filter' => 'auth']);
$routes->get('/kategori/create', 'Kategori::create',['filter' => 'auth']);
$routes->post('/kategori/save', 'Kategori::save',['filter' => 'auth']);
$routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1',['filter' => 'auth']);
$routes->post('/kategori/update/(:num)', 'Kategori::update/$1',['filter' => 'auth']);
$routes->get('/kategori/delete/(:num)', 'Kategori::delete/$1',['filter' => 'auth']);

// Routes untuk Controller Auth (Autentikasi)
$routes->get('/login', 'Auth::login');          // Menampilkan form login
$routes->post('/auth/proses_login', 'Auth::proses_login'); // Memproses login
$routes->get('/auth/logout', 'Auth::logout');        // Logout
$routes->get('/dashboard', 'Auth::dashboard', ['filter' => 'auth']);

// Routes untuk Controller User (Manajemen User)
$routes->get('/user', 'User::index', ['filter' => 'auth']);         // Daftar user (dengan filter auth)
$routes->get('/user/create', 'User::create', ['filter' => 'auth']);  // Form tambah user (dengan filter auth)
$routes->post('/user/save', 'User::save', ['filter' => 'auth']);     // Simpan user baru (dengan filter auth)
$routes->get('/user/edit/(:num)', 'User::edit/$1', ['filter' => 'auth']); // Form edit user (dengan filter auth)
$routes->post('/user/update/(:num)', 'User::update/$1', ['filter' => 'auth']); // Update user (dengan filter auth)
$routes->get('/user/delete/(:num)', 'User::delete/$1', ['filter' => 'auth']); // Hapus user (dengan filter auth)

// Transaksi Kasir
$routes->get('transaksi', 'Transaksi::index');
$routes->post('transaksi/scanBarcode', 'Transaksi::scanBarcode');
$routes->post('transaksi/updateJumlah', 'Transaksi::updateJumlah');
$routes->post('transaksi/proses', 'Transaksi::proses');
$routes->post('transaksi/clearKeranjang', 'Transaksi::clearKeranjang');
$routes->post('transaksi/hapusItem', 'Transaksi::hapusItem');
$routes->get('transaksi/struk/(:num)', 'Transaksi::tampilkanStruk/$1');



// Routes untuk Controller Laporan
$routes->get('laporan/penjualan', 'Laporan::penjualan', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'laporan/pendapatan', 'Laporan::pendapatan');
$routes->get('/laporan', 'Laporan::index', ['filter' => 'auth']);
$routes->post('/laporan/penjualan_harian', 'Laporan::penjualan_harian', ['filter' => 'auth']);
$routes->post('/laporan/penjualan_bulanan', 'Laporan::penjualan_bulanan', ['filter' => 'auth']);
$routes->post('/laporan/penjualan_periode', 'Laporan::penjualan_periode', ['filter' => 'auth']);
$routes->post('laporan/hapusSemuaTransaksi', 'Laporan::hapusSemuaTransaksi');
$routes->post('laporan/hapusTransaksi/(:num)', 'Laporan::hapusTransaksi/$1');
$routes->post('laporan/hapusSemuaPendapatan', 'Laporan::hapusSemuaPendapatan');