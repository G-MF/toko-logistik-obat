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

    $submit = $koneksi->query("INSERT INTO pembelian_obat VALUES (
            '$no_pembelian_obat', '$tanggal_pembelian', '$kode_supplier', '$nama_supplier', 0
        )");

    if ($submit) {
        $_SESSION['alert'] = "Data Berhasil Disimpan";
        $_SESSION['tipe']  = "success";
        echo "<script>window.location.replace('detail/index?id=" . $no_pembelian_obat . "');</script>";
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $no_pembelian_obat  = $_POST['no_pembelian_obat'];
        $tanggal_pembelian  = strip_tags($_POST['tanggal_pembelian']);
        $kode_supplier      = strip_tags($_POST['kode_supplier']);
        $nama_supplier      = strip_tags($_POST['nama_supplier']);

        $submit = $koneksi->query("UPDATE pembelian_obat SET
             tanggal_pembelian = '$tanggal_pembelian', 
             kode_supplier     = '$kode_supplier', 
             nama_supplier     = '$nama_supplier'
             WHERE no_pembelian_obat = '$no_pembelian_obat'
        ");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            echo "<script>window.location.replace('../pembelian-obat');</script>";
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            // $cek        = $koneksi->query("SELECT * FROM pembelian_obat WHERE no_pembelian_obat = '$_GET[id]'")->fetch_array();
            // $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok - '$cek[jumlah_obat]' WHERE kode_obat = '$cek[kode_obat]'");

            // if ($updatestok) {
            $hapus = $koneksi->query("DELETE FROM pembelian_obat WHERE no_pembelian_obat = '$_GET[id]'");
            if ($hapus) {

                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../pembelian-obat');</script>";
            }
            // }
        }
