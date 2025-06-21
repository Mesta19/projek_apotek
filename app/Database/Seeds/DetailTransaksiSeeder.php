<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_detail'=>1,'id_transaksi'=>2,'id_obat'=>21,'jumlah'=>4,'harga_satuan'=>10000.00,'subtotal'=>40000.00],
            ['id_detail'=>2,'id_transaksi'=>2,'id_obat'=>19,'jumlah'=>2,'harga_satuan'=>20000.00,'subtotal'=>40000.00],
            ['id_detail'=>3,'id_transaksi'=>3,'id_obat'=>17,'jumlah'=>2,'harga_satuan'=>110000.00,'subtotal'=>220000.00],
            ['id_detail'=>4,'id_transaksi'=>3,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>5,'id_transaksi'=>4,'id_obat'=>21,'jumlah'=>4,'harga_satuan'=>10000.00,'subtotal'=>40000.00],
            ['id_detail'=>6,'id_transaksi'=>4,'id_obat'=>15,'jumlah'=>2,'harga_satuan'=>10000.00,'subtotal'=>20000.00],
            ['id_detail'=>7,'id_transaksi'=>4,'id_obat'=>19,'jumlah'=>1,'harga_satuan'=>20000.00,'subtotal'=>20000.00],
            ['id_detail'=>8,'id_transaksi'=>5,'id_obat'=>21,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>9,'id_transaksi'=>5,'id_obat'=>20,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>10,'id_transaksi'=>6,'id_obat'=>21,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>11,'id_transaksi'=>6,'id_obat'=>20,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>12,'id_transaksi'=>7,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>13,'id_transaksi'=>7,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>14,'id_transaksi'=>8,'id_obat'=>15,'jumlah'=>2,'harga_satuan'=>10000.00,'subtotal'=>20000.00],
            ['id_detail'=>15,'id_transaksi'=>9,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>16,'id_transaksi'=>9,'id_obat'=>20,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>17,'id_transaksi'=>10,'id_obat'=>20,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>18,'id_transaksi'=>11,'id_obat'=>20,'jumlah'=>3,'harga_satuan'=>10000.00,'subtotal'=>30000.00],
            ['id_detail'=>19,'id_transaksi'=>12,'id_obat'=>20,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>20,'id_transaksi'=>12,'id_obat'=>17,'jumlah'=>1,'harga_satuan'=>110000.00,'subtotal'=>110000.00],
            ['id_detail'=>21,'id_transaksi'=>13,'id_obat'=>17,'jumlah'=>2,'harga_satuan'=>110000.00,'subtotal'=>220000.00],
            ['id_detail'=>22,'id_transaksi'=>14,'id_obat'=>17,'jumlah'=>1,'harga_satuan'=>110000.00,'subtotal'=>110000.00],
            ['id_detail'=>23,'id_transaksi'=>15,'id_obat'=>17,'jumlah'=>1,'harga_satuan'=>110000.00,'subtotal'=>110000.00],
            ['id_detail'=>24,'id_transaksi'=>16,'id_obat'=>17,'jumlah'=>1,'harga_satuan'=>110000.00,'subtotal'=>110000.00],
            ['id_detail'=>25,'id_transaksi'=>16,'id_obat'=>21,'jumlah'=>4,'harga_satuan'=>10000.00,'subtotal'=>40000.00],
            ['id_detail'=>26,'id_transaksi'=>16,'id_obat'=>15,'jumlah'=>4,'harga_satuan'=>10000.00,'subtotal'=>40000.00],
            ['id_detail'=>27,'id_transaksi'=>17,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>28,'id_transaksi'=>18,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>29,'id_transaksi'=>19,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>30,'id_transaksi'=>20,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>31,'id_transaksi'=>21,'id_obat'=>21,'jumlah'=>12,'harga_satuan'=>10000.00,'subtotal'=>120000.00],
            ['id_detail'=>32,'id_transaksi'=>21,'id_obat'=>16,'jumlah'=>10,'harga_satuan'=>50000.00,'subtotal'=>500000.00],
            ['id_detail'=>33,'id_transaksi'=>22,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>34,'id_transaksi'=>22,'id_obat'=>20,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>35,'id_transaksi'=>23,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>36,'id_transaksi'=>23,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>37,'id_transaksi'=>24,'id_obat'=>15,'jumlah'=>1,'harga_satuan'=>10000.00,'subtotal'=>10000.00],
            ['id_detail'=>38,'id_transaksi'=>24,'id_obat'=>16,'jumlah'=>2,'harga_satuan'=>50000.00,'subtotal'=>100000.00],
            ['id_detail'=>39,'id_transaksi'=>25,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>40,'id_transaksi'=>25,'id_obat'=>19,'jumlah'=>1,'harga_satuan'=>20000.00,'subtotal'=>20000.00],
            ['id_detail'=>41,'id_transaksi'=>26,'id_obat'=>22,'jumlah'=>1,'harga_satuan'=>2000.00,'subtotal'=>2000.00],
            ['id_detail'=>42,'id_transaksi'=>27,'id_obat'=>19,'jumlah'=>1,'harga_satuan'=>20000.00,'subtotal'=>20000.00],
            ['id_detail'=>43,'id_transaksi'=>28,'id_obat'=>19,'jumlah'=>1,'harga_satuan'=>20000.00,'subtotal'=>20000.00],
            ['id_detail'=>44,'id_transaksi'=>29,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>45,'id_transaksi'=>30,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>46,'id_transaksi'=>31,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>47,'id_transaksi'=>32,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>48,'id_transaksi'=>33,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>49,'id_transaksi'=>34,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>50,'id_transaksi'=>35,'id_obat'=>17,'jumlah'=>1,'harga_satuan'=>110000.00,'subtotal'=>110000.00],
            ['id_detail'=>51,'id_transaksi'=>35,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>52,'id_transaksi'=>36,'id_obat'=>16,'jumlah'=>1,'harga_satuan'=>50000.00,'subtotal'=>50000.00],
            ['id_detail'=>53,'id_transaksi'=>36,'id_obat'=>17,'jumlah'=>1,'harga_satuan'=>110000.00,'subtotal'=>110000.00],
        ];
        $this->db->table('detail_transaksi')->insertBatch($data);
    }
}
