<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';
require_once '../template/admin/script.php';

if (isset($_POST['edit-username'])) {
    $id_admin        = $_SESSION['id_admin'];
    $username_baru   = strip_tags($_POST['username']);
    $konfirmasi_pass = md5(strip_tags($_POST['konfirmasi_pass']));

    // cek karakter spasi di username
    if ($username_baru == trim($username_baru) && strpos($username_baru, ' ') !== false) {
        $_SESSION['sts'] = "error";
        $_SESSION['alert_ubah_username'] = "Username tidak boleh menggunakan Spasi !";
        echo "<script>window.history.back();</script>";
    } else {

        $cek_data = $koneksi->query("SELECT * FROM admin WHERE id_admin = '$id_admin' AND password = '$konfirmasi_pass'");

        if (mysqli_num_rows($cek_data) > 0) {
            $ubah = $koneksi->query("UPDATE admin SET username = '$username_baru' WHERE id_admin = '$id_admin'");
            if ($ubah) {
                $_SESSION['sts'] = "success";
                $_SESSION['alert_ubah_username'] = "Username Berhasil Diubah";
                echo "<script>window.history.back();</script>";
            }
        } else {
            $_SESSION['sts'] = "error";
            $_SESSION['alert_ubah_username'] = "Konfirmasi password salah !";
            echo "<script>window.history.back();</script>";
        }
    }
}
