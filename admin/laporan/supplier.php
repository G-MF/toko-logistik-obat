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
    <title>Laporan Supplier</title>

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
        LAPORAN SUPPLIER <br>
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
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>No. Hp</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $koneksi->query("SELECT * FROM supplier ORDER BY kode_supplier ASC");
            foreach ($data as $row) {
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td><?= $row['kode_supplier']; ?></td>
                    <td align="left"><?= $row['nama_supplier']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
                    <td align="left"><?= $row['alamat']; ?></td>
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

                Nama
            </td>
        </tr>
    </table>

</body>

</html>