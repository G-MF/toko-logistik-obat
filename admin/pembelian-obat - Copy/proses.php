<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $no_pembelian_obat  = $_POST['no_pembelian_obat'];
    $tanggal_pembelian  = strip_tags($_POST['tanggal_pembelian']);
    $kode_supplier      = strip_tags($_POST['kode_supplier']);
    $nama_supplier      = strip_tags($_POST['nama_supplier']);
    $kode_obat          = strip_tags($_POST['kode_obat']);
    $nama_obat          = strip_tags($_POST['nama_obat']);
    $harga_pembelian    = str_replace(".", "", $_POST['harga_pembelian']);
    $jumlah_obat        = strip_tags($_POST['jumlah_obat']);

    $submit = $koneksi->query("INSERT INTO pembelian_obat VALUES (
            '$no_pembelian_obat', '$tanggal_pembelian', '$kode_supplier', '$nama_supplier', '$kode_obat', '$nama_obat', '$harga_pembelian', '$jumlah_obat'
        )");

    if ($submit) {
        $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok + '$jumlah_obat' WHERE kode_obat = '$kode_obat'");

        $_SESSION['alert'] = "Data Berhasil Disimpan";
        echo "<script>window.location.replace('../pembelian-obat');</script>";
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $no_pembelian_obat  = $_POST['no_pembelian_obat'];
        $tanggal_pembelian  = strip_tags($_POST['tanggal_pembelian']);
        $kode_supplier      = strip_tags($_POST['kode_supplier']);
        $nama_supplier      = strip_tags($_POST['nama_supplier']);
        $kode_obat          = strip_tags($_POST['kode_obat']);
        $nama_obat          = strip_tags($_POST['nama_obat']);
        $harga_pembelian    = str_replace(".", "", $_POST['harga_pembelian']);
        $jumlah_obat        = strip_tags($_POST['jumlah_obat']);


        $cek          = $koneksi->query("SELECT * FROM pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat'")->fetch_array();
        $cekstok      = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$kode_obat'")->fetch_array();
        $updatejumlah = ($cekstok['jumlah_stok'] - $cek['jumlah_obat']) + $jumlah_obat;
        $updatestok   = $koneksi->query("UPDATE stok_obat SET jumlah_stok = '$updatejumlah' WHERE kode_obat = '$kode_obat'");

        $submit = $koneksi->query("UPDATE pembelian_obat SET
             tanggal_pembelian = '$tanggal_pembelian', 
             kode_supplier     = '$kode_supplier', 
             nama_supplier     = '$nama_supplier', 
             kode_obat         = '$kode_obat', 
             nama_obat         = '$nama_obat',
             harga_pembelian   = '$harga_pembelian',
             jumlah_obat       = '$jumlah_obat'
             WHERE no_pembelian_obat = '$no_pembelian_obat'
        ");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            echo "<script>window.location.replace('../pembelian-obat');</script>";
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $cek        = $koneksi->query("SELECT * FROM pembelian_obat WHERE no_pembelian_obat = '$_GET[id]'")->fetch_array();
            $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok - '$cek[jumlah_obat]' WHERE kode_obat = '$cek[kode_obat]'");

            if ($updatestok) {
                $hapus = $koneksi->query("DELETE FROM pembelian_obat WHERE no_pembelian_obat = '$_GET[id]'");
                if ($hapus) {

                    $_SESSION['alert'] = "Data Berhasil Dihapus";
                    echo "<script>window.location.replace('../pembelian-obat');</script>";
                }
            }
        }
