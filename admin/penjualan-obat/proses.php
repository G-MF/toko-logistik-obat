<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
include_once '../../template/admin/script.php';

// Simpan
if (isset($_POST['tambah'])) {
    $no_nota            = strip_tags($_POST['no_nota']);
    $tanggal_transaksi  = strip_tags($_POST['tanggal_transaksi']);
    $kode_pelanggan     = strip_tags($_POST['kode_pelanggan']);
    $nama_pelanggan     = strip_tags($_POST['nama_pelanggan']);
    $no_hp              = strip_tags($_POST['no_hp']);
    $alamat             = strip_tags($_POST['alamat']);

    $submit = $koneksi->query("INSERT INTO transaksi_penjualan VALUES (
            '$no_nota', '$tanggal_transaksi', '$kode_pelanggan', '$nama_pelanggan', '$no_hp', '$alamat', 0
        )");

    if ($submit) {
        $_SESSION['alert'] = "Data Berhasil Disimpan";
        echo "<script>window.location.replace('detail/index?id=" . $no_nota . "');</script>";
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
            $hapus = $koneksi->query("DELETE FROM transaksi_penjualan WHERE no_nota = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../penjualan-obat');</script>";
            }
        }
