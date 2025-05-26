<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
            font-size: 14px;
        }
        .struk-container {
            width: 350px;
            padding: 15px;
            margin: 15px auto;
            border-bottom: 1px dashed #000;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        .table th, .table td {
            padding: 3px;
            text-align: left;
            border-bottom: 1px dotted #eee;
            font-size: 14px; /* Ukuran font sel tabel diperbesar */
        }
        .table th {
            font-weight: bold;
            font-size: 16px;
        }
        .total {
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px solid #000;
            font-size: 16px;
        }
        .total p {
            display: flex;
            justify-content: space-between;
        }
        .store-info {
            margin-bottom: 12px;
        }
        .store-info h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .store-info p {
            font-size: 14px;
            margin-bottom: 3px;
        }
        .thank-you {
            margin-top: 18px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="struk-container">
        <div class="store-info text-center">
            <h3>ApotekKu</h3>
            <p><?= date('d-m-Y H:i:s', strtotime($tanggal_transaksi)) ?></p>
            <p>No: <?= esc($nomor_transaksi) ?></p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 180px;">Obat</th>
                    <th class="text-right" style="width: 70px;">Harga</th>
                    <th class="text-right" style="width: 40px;">Jml</th>
                    <th class="text-right" style="width: 100px;">Subtotal</th>
                </tr>
                <tr>
                    <th style="border-bottom: 1px solid #000;"></th>
                    <th style="border-bottom: 1px solid #000;" class="text-right"></th>
                    <th style="border-bottom: 1px solid #000;" class="text-right"></th>
                    <th style="border-bottom: 1px solid #000;" class="text-right"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($detail_transaksi as $item): ?>
                <tr>
                    <td><?= esc($item['nama_obat']) ?></td>
                    <td class="text-right"><?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td class="text-right"><?= esc($item['jumlah']) ?></td>
                    <td class="text-right"><?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">
            <p>Total: <span class="text-right"><?= number_format($total, 0, ',', '.') ?></span></p>
            <p>Bayar: <span class="text-right"><?= number_format($bayar, 0, ',', '.') ?></span></p>
            <p>Kembali: <span class="text-right"><?= number_format($kembalian, 0, ',', '.') ?></span></p>
        </div>
        <div class="thank-you text-center">
            <hr style="margin-top: 10px; margin-bottom: 5px; border-top: 1px dashed #000;">
            <p>--- Terima Kasih ---</p>
            <p>Semoga Lekas Sembuh</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>