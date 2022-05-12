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
    <title>Laporan Transaksi Penjualan Obat-obatan</title>

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
        LAPORAN TRANSAKSI PENJUALAN OBAT-OBATAN <br>
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
                <th>No. Nota</th>
                <th>Tanggal Transaksi</th>
                <th>Kode Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>No. Hp</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $koneksi->query("SELECT * FROM transaksi_penjualan ORDER BY no_nota DESC");
            foreach ($data as $row) {
            ?>
                <tr align="center">
                    <td><?= $no++; ?></td>
                    <td><?= $row['no_nota']; ?></td>
                    <td><?= tgl_indo($row['tanggal_transaksi']); ?></td>
                    <td><?= $row['kode_pelanggan']; ?></td>
                    <td align="left"><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
                    <td align="left"><?= $row['alamat']; ?></td>
                </tr>

                <!-- DETAIL ITEM OBAT -->
                <tr>
                    <th></th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Harga Jual</th>
                    <th>Jenis Obat</th>
                    <th>Banyak Beli</th>
                    <th>Sub Total</th>
                </tr>

                <?php
                $detail = $koneksi->query("SELECT * FROM detail_transaksi_penjualan WHERE no_nota = '$row[no_nota]'");
                foreach ($detail as $item) {
                ?>
                    <tr align="center">
                        <td></td>
                        <td><?= $item['kode_obat']; ?></td>
                        <td align="left"><?= $item['nama_obat']; ?></td>
                        <td align="right"><?= rupiah($item['harga_jual']); ?></td>
                        <td><?= $item['jenis_obat']; ?></td>
                        <td><?= $item['banyak_beli']; ?></td>
                        <td align="right"><?= rupiah($item['harga_jual'] * $item['banyak_beli']); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="6" align="right">Total Bayar</th>
                    <th align="right"><?= rupiah($row['total_bayar']) ?></th>
                </tr>
            <?php } ?>
        </tbody>
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