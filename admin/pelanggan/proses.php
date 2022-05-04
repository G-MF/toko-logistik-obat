<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $kode_pelanggan = strip_tags($_POST['kode_pelanggan']);
    $nama_pelanggan = strip_tags($_POST['nama_pelanggan']);
    $jenis_kelamin  = strip_tags($_POST['jenis_kelamin']);
    $no_hp          = strip_tags($_POST['no_hp']);
    $alamat         = strip_tags($_POST['alamat']);

    $submit = $koneksi->query("INSERT INTO pelanggan VALUES (
        '$kode_pelanggan',
        '$nama_pelanggan',
        '$jenis_kelamin',
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
        $kode_pelanggan = strip_tags($_POST['kode_pelanggan']);
        $nama_pelanggan = strip_tags($_POST['nama_pelanggan']);
        $jenis_kelamin  = strip_tags($_POST['jenis_kelamin']);
        $no_hp          = strip_tags($_POST['no_hp']);
        $alamat         = strip_tags($_POST['alamat']);

        $submit = $koneksi->query("UPDATE pelanggan SET 
                  nama_pelanggan = '$nama_pelanggan',
                  jenis_kelamin = '$jenis_kelamin', 
                  no_hp         = '$no_hp', 
                  alamat        = '$alamat'
            WHERE kode_pelanggan = '$kode_pelanggan'");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            echo "<script>window.location.replace('../pelanggan');</script>";
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM pelanggan WHERE kode_pelanggan = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../pelanggan');</script>";
            }
        }
