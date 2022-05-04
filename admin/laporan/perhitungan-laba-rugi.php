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
    <title>Laporan Perhitungan Laba Rugi</title>

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
        LAPORAN PERHITUNGAN LABA RUGI OBAT-OBATAN <br>
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
                <th>No. Perhitungan</th>
                <th>Tanggal Perhitungan</th>
                <th>Keuntungan Penjualan</th>
                <th>Total Pembelian</th>
                <th>Gajih Karyawan</th>
                <th>Biaya Listrik</th>
                <th>Biaya PDAM</th>
                <th>Total Keuntungan Bersih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $koneksi->query("SELECT * FROM perhitungan_laba_rugi ORDER BY no_perhitungan DESC");
            foreach ($data as $row) {
            ?>
                <tr align="center">
                    <td><?= $row['no_perhitungan']; ?></td>
                    <td><?= tgl_indo($row['tgl_perhitungan']); ?></td>
                    <td align="right"><?= rupiah($row['keuntungan_penjualan']); ?></td>
                    <td align="right"><?= rupiah($row['total_pembelian']); ?></td>
                    <td align="right"><?= rupiah($row['gajih_karyawan']); ?></td>
                    <td align="right"><?= rupiah($row['biaya_listrik']); ?></td>
                    <td align="right"><?= rupiah($row['biaya_pdam']); ?></td>
                    <td align="right"><?= rupiah($row['total_keuntungan_bersih']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" align="right">Total</th>
                <th align="right">
                    <?php
                    $query = $koneksi->query("SELECT SUM(total_keuntungan_bersih) as total FROM perhitungan_laba_rugi")->fetch_array();
                    $total = $query['total'];
                    if ($total > 0) {
                        echo rupiah($total);
                    } else {
                        echo 0;
                    }
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

                Nama
            </td>
        </tr>
    </table>

</body>

</html>