<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian Obat-obatan</title>

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
        LAPORAN PEMBELIAN OBAT-OBATAN <br>
        PADA TOKO ARIF FAJAR TABALONG
        <img src="<?= base_url('assets/img/blank.jpg') ?>" width="60" height="75" alt="">
    </div>

    <hr size="2" color="black">

    <div style="float: right; margin-bottom: 20px; margin-top: 10px;">
        Tanggal cetak laporan : <?= tgl_indo(date('Y-m-d')) ?>
    </div>

    <table border="1" cellpadding="3">
        <thead>
            <tr>
                <th>No</th>
                <th>No. Pembelian Obat</th>
                <th>Tanggal Pembelian</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $koneksi->query("SELECT * FROM pembelian_obat ORDER BY no_pembelian_obat DESC");
            foreach ($data as $row) {
            ?>
            <tr align="center">
                <td><?= $no++; ?></td>
                <td><?= $row['no_pembelian_obat']; ?></td>
                <td><?= tgl_indo($row['tanggal_pembelian']); ?></td>
                <td><?= $row['kode_supplier']; ?></td>
                <td align="left"><?= $row['nama_supplier']; ?></td>
                <td></td>
            </tr>

            <!-- DETAIL ITEM OBAT -->
            <tr>
                <th></th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Harga Pembeliian</th>
                <th>Jumlah Beli</th>
                <th>Sub Total</th>
            </tr>

            <?php
                $detail = $koneksi->query("SELECT * FROM detail_pembelian_obat WHERE no_pembelian_obat = '$row[no_pembelian_obat]'");
                foreach ($detail as $item) {
                ?>
            <tr align="center">
                <td></td>
                <td><?= $item['kode_obat']; ?></td>
                <td align="left"><?= $item['nama_obat']; ?></td>
                <td align="right"><?= rupiah($item['harga_pembelian']); ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td align="right"><?= rupiah($item['harga_pembelian'] * $item['jumlah']); ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th colspan="5" align="right">Total Pembelian</th>
                <th align="right"><?= rupiah($row['total_pembelian']) ?></th>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" align="right">Total Keseluruhan Pembelian</th>
                <th align="right">
                    <?php
                    $total_semua = $koneksi->query("SELECT SUM(total_pembelian) as total FROM pembelian_obat")->fetch_array();
                    echo rupiah($total_semua['total']);
                    ?>
                </th>
            </tr>
        </tfoot>
    </table>

    <br>

    <table border="0">
        <tr align="center">
            <td width="70%"></td>
            <td>
                Mengetahui <br>
                Pemilik, <br>
                Toko Arif Fajar Tabalong
                <br><br><br><br><br>

                Muhammad Fitri Azhari
            </td>
        </tr>
    </table>

</body>

</html>