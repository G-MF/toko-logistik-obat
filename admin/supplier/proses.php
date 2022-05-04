<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $kode_supplier = strip_tags($_POST['kode_supplier']);
    $nama_supplier = strip_tags($_POST['nama_supplier']);
    $no_hp         = strip_tags($_POST['no_hp']);
    $alamat        = strip_tags($_POST['alamat']);

    $submit = $koneksi->query("INSERT INTO supplier VALUES (
        '$kode_supplier',
        '$nama_supplier',
        '$no_hp',
        '$alamat'
    )");

    if ($submit) {
        $_SESSION['alert'] = "Data Berhasil Disimpan";
        echo "<script>window.location.replace('../pelanggan');</script>";
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $kode_supplier = strip_tags($_POST['kode_supplier']);
        $nama_supplier = strip_tags($_POST['nama_supplier']);
        $no_hp         = strip_tags($_POST['no_hp']);
        $alamat        = strip_tags($_POST['alamat']);

        $submit = $koneksi->query("UPDATE supplier SET 
                  nama_supplier = '$nama_supplier', 
                  no_hp         = '$no_hp', 
                  alamat        = '$alamat'
            WHERE kode_supplier = '$kode_supplier'");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            echo "<script>window.location.replace('../pelanggan');</script>";
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM supplier WHERE kode_supplier = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../pelanggan');</script>";
            }
        }
