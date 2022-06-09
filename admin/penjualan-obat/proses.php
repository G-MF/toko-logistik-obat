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
        // 
    } else
        $cek = $koneksi->query("SELECT * FROM detail_transaksi_penjualan WHERE no_nota = '$_GET[id]'");
        foreach ($cek as $item) {
            $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok + '$item[banyak_beli]' WHERE kode_obat = '$item[kode_obat]'");
            $koneksi->query("DELETE FROM detail_transaksi_penjualan WHERE id_detail = '$item[id_detail]'");
        }

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM transaksi_penjualan WHERE no_nota = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                echo "<script>window.location.replace('../penjualan-obat');</script>";
            }
        }