<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$no_pembelian_obat = $_GET['id'];
$data    = $koneksi->query("SELECT * FROM pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat'")->fetch_array();
$detail  = $koneksi->query("SELECT * FROM detail_pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian Obat-obatan</title>

    <style>
        .kop {
            justify-content: space-between;
            font-size: 25px;
            font-weight: bold;
            line-height: 30px;
            text-align: center;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .judul {
            justify-content: center;
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            vertical-align: middle;
        }
    </style>
</head>

<script type="text/javascript">
    window.print();
</script>

<body>

    <div class="kop">
        <img src="<?= base_url('assets/img/drugstore-icon.png') ?>" width="60" height="75" alt="">
        NOTA PEMBELIAN OBAT-OBATAN <br>
        PADA TOKO ARIF FAJAR TABALONG
        <img src="<?= base_url('assets/img/blank.jpg') ?>" width="60" height="75" alt="">
    </div>

    <hr size="2" color="black">

    <table border="0" width="100%">
        <tr>
            <td width="20%">No. Pembelian Obat</td>
            <td align="right">:</td>
            <td><?= $data['no_pembelian_obat'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Pembelian</td>
            <td align="right">:</td>
            <td><?= tgl_indo($data['tanggal_pembelian']) ?></td>
        </tr>
        <tr>
            <td>Kode Supplier</td>
            <td align="right">:</td>
            <td><?= $data['kode_supplier'] ?></td>
        </tr>
        <tr>
            <td>Nama Supplier</td>
            <td align="right">:</td>
            <td><?= $data['nama_supplier'] ?></td>
        </tr>
    </table>

    <br>

    <table border="1" cellpadding="3">
        <thead>
            <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Harga Obat</th>
                <th>Jumlah Beli</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($detail as $row) {
            ?>
                <tr align="center">
                    <td><?= $row['kode_obat']; ?></td>
                    <td align="left"><?= $row['nama_obat']; ?></td>
                    <td><?= $row['harga_pembelian']; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td align="right"><?= rupiah($row['harga_pembelian'] * $row['jumlah']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" align="right">Total Pembelian</th>
                <th align="right"><?= rupiah($data['total_pembelian']) ?></th>
            </tr>
        </tfoot>
    </table>

    <br>

    <div style="float: right; margin-bottom: 20px; margin-top: 10px;">
        Tanggal : <?= tgl_indo(date('Y-m-d')) ?>
    </div>

    <table border="0">
        <tr align="center">
            <td width="70%"></td>
            <td>
                Mengetahui <br>
                Hormat Kami, <br>
            </td>
        </tr>
    </table>

</body>

</html>