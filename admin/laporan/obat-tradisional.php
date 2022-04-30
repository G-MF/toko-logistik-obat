<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
$data = $koneksi->query("SELECT * FROM obat ORDER BY nama_obat ASC");

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Obat Tradisional</title>

    <style>
        .kop {
            justify-content: space-between;
            font-size: 35px;
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
            margin-top: 15px;
            border-collapse: collapse;
        }

        th {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="kop">
        <img src="<?= base_url('assets/img/logo-prov.png') ?>" width="60" height="75" alt="">
        DINAS KESEHATAN <br>
        KALIMANTAN SELATAN
        <img src="<?= base_url('assets/img/blank.jpg') ?>" width="60" height="75" alt="">
    </div>

    <hr size="2" color="black">

    <div class="judul">
        Laporan Obat Tradisional
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Obat</th>
                <th>Nama Obat</th>
                <th>Deskripsi</th>
                <th>Indikasi</th>
                <th>Aturan Pakai</th>
                <th>Nama Tanaman</th>
                <th>Komposisi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) {
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td align="center"><?= $row['kode_obat']; ?></td>
                    <td><?= $row['nama_obat']; ?></td>
                    <td align="justify"><?= $row['deskripsi']; ?></td>
                    <td><?= $row['indikasi']; ?></td>
                    <td><?= $row['aturan_pakai']; ?></td>
                    <td><?= $row['nama_tanaman']; ?></td>
                    <td><?= $row['komposisi']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>

    <table border="0">
        <tr>
            <td width="80%"></td>
            <td>
                Banjarmasin, <?= tgl_indo(date('Y-m-d')) ?> <br><br>
                Mengetahui <br>
                Kepala Dinas <br><br>

                Nama :
                <hr style="margin-top: 0px; margin-bottom: 0px; border-top: 1px solid #000; border-bottom: white; border-left: white; border-right: white;">
                NIP &nbsp;&nbsp; :
            </td>
        </tr>
    </table>

</body>


<script type="text/javascript">
    window.print();
</script>

</html>