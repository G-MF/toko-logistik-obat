<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $nama = strip_tags($_POST['nama']);

    $submit = $koneksi->query("INSERT INTO kelompok_tanaman VALUES (NULL, '$nama')");

    if ($submit) {
        $_SESSION['alert'] = "Data Berhasil Disimpan";
        header("location: ../kelompok-tanaman", true, 301);
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_kelompok = strip_tags($_POST['id_kelompok']);
        $nama        = strip_tags($_POST['nama']);

        $submit = $koneksi->query("UPDATE kelompok_tanaman SET nama = '$nama' WHERE id_kelompok = '$id_kelompok'");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            header("location: ../kelompok-tanaman", true, 301);
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM kelompok_tanaman WHERE id_kelompok = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../kelompok-tanaman", true, 301);
            }
        }
