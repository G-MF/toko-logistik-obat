<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';
include_once '../../../template/admin/script.php';

// total bayar
function sum_total($no_nota, $koneksi)
{
    $sum    = $koneksi->query("SELECT sum(sub_total) as total FROM detail_transaksi_penjualan WHERE no_nota = '$no_nota'")->fetch_array();

    if ($sum) {
        $total = $sum['total'];
    } else {
        $total = 0;
    }

    $koneksi->query("UPDATE transaksi_penjualan SET total_bayar = '$total' WHERE no_nota = '$no_nota'");
}


// Simpan
if (isset($_POST['tambah'])) {
    $no_nota     = strip_tags($_POST['no_nota']);
    $kode_obat   = strip_tags($_POST['kode_obat']);
    $nama_obat   = strip_tags($_POST['nama_obat']);
    $harga_jual  = strip_tags(str_replace(".", "", $_POST['harga_jual']));
    $jenis_obat  = strip_tags($_POST['jenis_obat']);
    $jumlah_stok = strip_tags($_POST['jumlah_stok']);
    $banyak_beli = strip_tags($_POST['banyak_beli']);
    $sub_total   = strip_tags(str_replace(".", "", $_POST['sub_total']));

    $cek = $koneksi->query("SELECT kode_obat FROM detail_transaksi_penjualan WHERE no_nota = '$no_nota' AND kode_obat = '$kode_obat'");
    if ($cek->num_rows > 0) {
        $_SESSION['alert'] = "Kode obat sudah ada";
        $_SESSION['tipe'] = "error";
        echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_nota . '">';
    } else {

        // cek banyak beli
        if ($jumlah_stok < $banyak_beli) {
            $_SESSION['alert'] = "Banyak beli melebihi jumlah stok";
            $_SESSION['tipe'] = "error";
            echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_nota . '">';
        } else {

            $submit = $koneksi->query("INSERT INTO detail_transaksi_penjualan VALUES (
            null, '$no_nota', '$kode_obat', '$nama_obat', '$harga_jual', '$jenis_obat', '$banyak_beli', '$sub_total'
        )");

            if ($submit) {
                // update jumlah stok
                $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok - '$banyak_beli' WHERE kode_obat = '$kode_obat'");

                // total bayar
                sum_total($no_nota, $koneksi);

                $_SESSION['alert'] = "Data Berhasil Disimpan";
                $_SESSION['tipe'] = "success";
                echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_nota . '">';
            }
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_detail   = strip_tags($_POST['id_detail']);
        $no_nota     = strip_tags($_POST['no_nota']);
        $jumlah_stok = strip_tags($_POST['jumlah_stok']);
        $banyak_beli = strip_tags($_POST['banyak_beli']);
        $sub_total   = strip_tags(str_replace(".", "", $_POST['sub_total']));

        // cek banyak beli
        if ($jumlah_stok < $banyak_beli) {
            $_SESSION['alert'] = "Banyak beli melebihi jumlah stok";
            $_SESSION['tipe'] = "error";
            echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_nota . '">';
        }

        $cek          = $koneksi->query("SELECT * FROM detail_transaksi_penjualan WHERE id_detail = '$id_detail'")->fetch_array();
        $cekstok      = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$cek[kode_obat]'")->fetch_array();
        $updatejumlah = ($cekstok['jumlah_stok'] + $cek['banyak_beli']) - $banyak_beli;

        $submit = $koneksi->query("UPDATE detail_transaksi_penjualan SET 
            banyak_beli = '$banyak_beli', sub_total = '$sub_total' WHERE id_detail = '$id_detail'
        ");

        if ($submit) {
            $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = '$updatejumlah' WHERE kode_obat = '$cek[kode_obat]'");

            // total bayar
            sum_total($no_nota, $koneksi);

            $_SESSION['alert'] = "Data Berhasil Diubah";
            $_SESSION['tipe']  = "success";
            echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_nota . '">';
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $data        = $koneksi->query("SELECT no_nota, kode_obat, banyak_beli FROM detail_transaksi_penjualan WHERE id_detail = '$_GET[id]'")->fetch_array();

            $no_nota     = $data['no_nota'];
            $kode_obat   = $data['kode_obat'];
            $banyak_beli = $data['banyak_beli'];

            // update jumlah stok
            $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok + '$banyak_beli' WHERE kode_obat = '$kode_obat'");

            if ($updatestok) {
                // hapus data
                $koneksi->query("DELETE FROM detail_transaksi_penjualan WHERE id_detail = '$_GET[id]'");

                // total bayar
                sum_total($no_nota, $koneksi);

                $_SESSION['alert'] = "Data Berhasil Dihapus";
                $_SESSION['tipe']  = "success";
                echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_nota . '">';
            }
        }
