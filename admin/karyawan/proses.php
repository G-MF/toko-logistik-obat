<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $kode_karyawan = strip_tags($_POST['kode_karyawan']);
    $nama_karyawan = strip_tags($_POST['nama_karyawan']);
    $jenis_kelamin = strip_tags($_POST['jenis_kelamin']);
    $no_hp         = strip_tags($_POST['no_hp']);
    $alamat        = strip_tags($_POST['alamat']);

    $submit = $koneksi->query("INSERT INTO karyawan VALUES (
        '$kode_karyawan',
        '$nama_karyawan',
        '$jenis_kelamin',
        '$no_hp',
        '$alamat'
    )");

    if ($submit) {
        $_SESSION['alert'] = "Data Berhasil Disimpan";
        echo "<script>window.location.replace('../karyawan');</script>";
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $kode_karyawan = strip_tags($_POST['kode_karyawan']);
        $nama_karyawan = strip_tags($_POST['nama_karyawan']);
        $jenis_kelamin = strip_tags($_POST['jenis_kelamin']);
        $no_hp         = strip_tags($_POST['no_hp']);
        $alamat        = strip_tags($_POST['alamat']);

        $submit = $koneksi->query("UPDATE karyawan SET 
                  nama_karyawan = '$nama_karyawan',
                  jenis_kelamin = '$jenis_kelamin', 
                  no_hp         = '$no_hp', 
                  alamat        = '$alamat'
            WHERE kode_karyawan = '$kode_karyawan'");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            echo "<script>window.location.replace('../karyawan');</script>";
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM karyawan WHERE kode_karyawan = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../karyawan');</script>";
            }
        }
