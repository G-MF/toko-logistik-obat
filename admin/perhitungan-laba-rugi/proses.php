<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $no_perhitungan          = strip_tags($_POST['no_perhitungan']);
    $tgl_perhitungan         = strip_tags($_POST['tgl_perhitungan']);
    $keuntungan_penjualan    = strip_tags(str_replace(".", "", $_POST['keuntungan_penjualan']));
    $total_pembelian         = strip_tags(str_replace(".", "", $_POST['total_pembelian']));
    $gajih_karyawan          = strip_tags(str_replace(".", "", $_POST['gajih_karyawan']));
    $biaya_listrik           = strip_tags(str_replace(".", "", $_POST['biaya_listrik']));
    $biaya_pdam              = strip_tags(str_replace(".", "", $_POST['biaya_pdam']));
    $total_keuntungan_bersih = strip_tags(str_replace(".", "", $_POST['total_keuntungan_bersih']));

    $submit = $koneksi->query("INSERT INTO perhitungan_laba_rugi VALUES (
        '$no_perhitungan',
        '$tgl_perhitungan',
        '$keuntungan_penjualan',
        '$total_pembelian',
        '$gajih_karyawan',
        '$biaya_listrik',
        '$biaya_pdam',
        '$total_keuntungan_bersih'
    )");

    if ($submit) {
        $_SESSION['alert'] = "Data Berhasil Disimpan";
        echo '<meta http-equiv="refresh" content="0; url=../perhitungan-laba-rugi">';
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $no_perhitungan          = strip_tags($_POST['no_perhitungan']);
        $tgl_perhitungan         = strip_tags($_POST['tgl_perhitungan']);
        $keuntungan_penjualan    = strip_tags(str_replace(".", "", $_POST['keuntungan_penjualan']));
        $total_pembelian         = strip_tags(str_replace(".", "", $_POST['total_pembelian']));
        $gajih_karyawan          = strip_tags(str_replace(".", "", $_POST['gajih_karyawan']));
        $biaya_listrik           = strip_tags(str_replace(".", "", $_POST['biaya_listrik']));
        $biaya_pdam              = strip_tags(str_replace(".", "", $_POST['biaya_pdam']));
        $total_keuntungan_bersih = strip_tags(str_replace(".", "", $_POST['total_keuntungan_bersih']));

        $submit = $koneksi->query("UPDATE perhitungan_laba_rugi SET 
                  tgl_perhitungan         = '$tgl_perhitungan',
                  keuntungan_penjualan    = '$keuntungan_penjualan', 
                  total_pembelian         = '$total_pembelian', 
                  gajih_karyawan          = '$gajih_karyawan',
                  biaya_listrik           = '$biaya_listrik',
                  biaya_pdam              = '$biaya_pdam',
                  total_keuntungan_bersih = '$total_keuntungan_bersih'
            WHERE no_perhitungan = '$no_perhitungan'");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            echo '<meta http-equiv="refresh" content="0; url=../perhitungan-laba-rugi">';
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM perhitungan_laba_rugi WHERE no_perhitungan = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo '<meta http-equiv="refresh" content="0; url=../perhitungan-laba-rugi">';
            }
        }
