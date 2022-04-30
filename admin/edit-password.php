<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';
require_once '../template/admin/script.php';

if (isset($_POST['edit-pw'])) {
    $username  = $_SESSION['username'];
    $pass_lama = md5(strip_tags($_POST['pass_lama']));
    $pass_baru = md5(strip_tags($_POST['pass_baru']));

    $cek_pass_lama = $koneksi->query("SELECT * FROM admin WHERE password = '$pass_lama'")->fetch_array();

    if ($cek_pass_lama) {
        $ubah = $koneksi->query("UPDATE admin SET username = '$username', password = '$pass_baru'");
        if ($ubah) {
            $_SESSION['sts'] = "success";
            $_SESSION['alert_ubah_pw'] = "Password Berhasil Diubah";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $_SESSION['sts'] = "error";
        $_SESSION['alert_ubah_pw'] = "Password Lama Yang Anda Masukkan Salah!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
