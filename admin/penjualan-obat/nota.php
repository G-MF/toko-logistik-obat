<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$no_nota = $_GET['id'];
$data    = $koneksi->query("SELECT * FROM transaksi_penjualan WHERE no_nota = '$no_nota'")->fetch_array();
$detail  = $koneksi->query("SELECT * FROM detail_transaksi_penjualan WHERE no_nota = '$no_nota'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penjualan Obat-obatan</title>

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
        NOTA TRANSAKSI PENJUALAN OBAT-OBATAN <br>
        PADA TOKO ARIF FAJAR TABALONG
        <img src="<?= base_url('assets/img/blank.jpg') ?>" width="60" height="75" alt="">
    </div>

    <hr size="2" color="black">

    <table border="0" width="100%">
        <tr>
            <td width="18%">No. Nota</td>
            <td align="right">:</td>
            <td><?= $data['no_nota'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Transaksi</td>
            <td align="right">:</td>
            <td><?= tgl_indo($data['tanggal_transaksi']) ?></td>
        </tr>
        <tr>
            <td>Kode Pelanggan</td>
            <td align="right">:</td>
            <td><?= $data['kode_pelanggan'] ?></td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td align="right">:</td>
            <td><?= $data['nama_pelanggan'] ?></td>
        </tr>
        <tr>
            <td>No. Hp</td>
            <td align="right">:</td>
            <td><?= $data['no_hp'] ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td align="right">:</td>
            <td><?= $data['alamat'] ?></td>
        </tr>
    </table>

    <br>

    <table border="1" cellpadding="3">
        <thead>
            <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Jenis Obat</th>
                <th>Harga Obat</th>
                <th>Banyak Beli</th>
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
                    <td><?= $row['jenis_obat']; ?></td>
                    <td><?= $row['harga_jual']; ?></td>
                    <td><?= $row['banyak_beli']; ?></td>
                    <td align="right"><?= rupiah($row['harga_jual'] * $row['banyak_beli']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" align="right">Total Bayar</th>
                <th align="right"><?= rupiah($data['total_bayar']) ?></th>
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