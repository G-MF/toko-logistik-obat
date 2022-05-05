<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $kode_obat       = $_POST['kode_obat'];
    $nama_obat       = strip_tags($_POST['nama_obat']);
    $harga_pembelian = str_replace(".", "", $_POST['harga_pembelian']);
    $harga_jual      = str_replace(".", "", $_POST['harga_jual']);
    $jenis_obat      = strip_tags($_POST['jenis_obat']);
    $jumlah_stok     = strip_tags($_POST['jumlah_stok']);
    $dosis_obat      = strip_tags($_POST['dosis_obat']);
    $ket_obat        = strip_tags($_POST['ket_obat']);

    $gambar      = $_FILES['gambar_obat']['name'];
    $size_gambar = $_FILES['gambar_obat']['size'];
    $x_gambar    = explode('.', $gambar);
    $ext_gambar  = end($x_gambar);
    $ext_allow   = array('png', 'jpg', 'jpeg');
    $nama_gambar = $x_gambar[0] . rand(1, 99999) . '.' . $ext_gambar;
    $tmp_gambar  = $_FILES['gambar_obat']['tmp_name'];
    $dir_gambar  = '../../assets/gambar-obat/';

    $cek = $koneksi->query("SELECT nama_obat FROM stok_obat WHERE nama_obat = '$nama_obat'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['alert_input'] = "Nama obat sudah ada";
        echo "<script>javascript:history.back()</script>";
    } else {

        if (in_array($ext_gambar, $ext_allow) === false) {
            $_SESSION['alert_input'] = "Format Gambar Tidak Diterima!";
            echo "<script>javascript:history.back()</script>";
        } else {

            $submit = $koneksi->query("INSERT INTO stok_obat VALUES (
            '$kode_obat', '$nama_obat', '$harga_pembelian', '$harga_jual', '$jenis_obat', '$nama_gambar', '$jumlah_stok', '$dosis_obat', '$ket_obat'
        )");

            if ($submit) {
                move_uploaded_file($tmp_gambar, $dir_gambar . $nama_gambar);
                $_SESSION['alert'] = "Data Berhasil Disimpan";
                echo "<script>window.location.replace('../stok');</script>";
            }
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $kode_obat       = $_POST['kode_obat'];
        $nama_obat       = strip_tags($_POST['nama_obat']);
        $harga_pembelian = str_replace(".", "", $_POST['harga_pembelian']);
        $harga_jual      = str_replace(".", "", $_POST['harga_jual']);
        $jenis_obat      = strip_tags($_POST['jenis_obat']);
        $jumlah_stok     = strip_tags($_POST['jumlah_stok']);
        $dosis_obat      = strip_tags($_POST['dosis_obat']);
        $ket_obat        = strip_tags($_POST['ket_obat']);


        $cekgambar   = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$kode_obat'")->fetch_array();
        $gambar_lama = $cekgambar['gambar_obat'];

        $event = NULL;

        $cek = $koneksi->query("SELECT nama_obat FROM stok_obat WHERE kode_obat != '$kode_obat'");
        foreach ($cek as $item) {
            if ($item['nama_obat'] == $nama_obat) {
                $_SESSION['alert_input'] = "Nama obat sudah ada";
                $event = 'ada';
                echo "<script>javascript:history.back()</script>";
            }
        }

        if ($event == NULL) {

            if ($_FILES['gambar_obat']['name']) {
                $gambar      = $_FILES['gambar_obat']['name'];
                $size_gambar = $_FILES['gambar_obat']['size'];
                $x_gambar    = explode('.', $gambar);
                $ext_gambar  = end($x_gambar);
                $ext_allow   = array('png', 'jpg', 'jpeg');
                $nama_gambar = $x_gambar[0] . rand(1, 99999) . '.' . $ext_gambar;
                $tmp_gambar  = $_FILES['gambar_obat']['tmp_name'];
                $dir_gambar  = '../../assets/gambar-obat/';

                if (in_array($ext_gambar, $ext_allow) === false) {
                    $_SESSION['alert_input'] = "Format Gambar Tidak Diterima!";
                    echo "<script>javascript:history.back()</script>";
                    die;
                }
            } else {
                $nama_gambar = $gambar_lama;
            }

            $submit = $koneksi->query("UPDATE stok_obat SET
                    nama_obat       = '$nama_obat', 
                    harga_pembelian = '$harga_pembelian', 
                    harga_jual      = '$harga_jual', 
                    gambar_obat     = '$nama_gambar', 
                    jenis_obat      = '$jenis_obat',
                    jumlah_stok     = '$jumlah_stok',
                    dosis_obat      = '$dosis_obat',
                    ket_obat        = '$ket_obat'
                    WHERE kode_obat = '$kode_obat'
                ");

            if ($submit) {
                if (!empty($_FILES['gambar_obat']['name'])) {
                    move_uploaded_file($tmp_gambar, $dir_gambar . $nama_gambar);
                    if (file_exists($dir_gambar . $gambar_lama)) {
                        unlink($dir_gambar . $gambar_lama);
                    }
                }
                $_SESSION['alert'] = "Data Berhasil Diubah";
                echo "<script>window.location.replace('../stok');</script>";
            }
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $cek = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$_GET[id]'")->fetch_array();
            $gambar_lama = $cek['gambar_obat'];

            $hapus = $koneksi->query("DELETE FROM stok_obat WHERE kode_obat = '$_GET[id]'");

            if ($hapus) {
                unlink('../../assets/gambar-obat/' . $gambar_lama);
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../stok');</script>";
            }
        }
