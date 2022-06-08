<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';
include_once '../../../template/admin/script.php';

// total bayar
function sum_total($no_pembelian_obat, $koneksi)
{
    $sum    = $koneksi->query("SELECT sum(sub_total) as total FROM detail_pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat'")->fetch_array();

    if ($sum) {
        $total = $sum['total'];
    } else {
        $total = 0;
    }

    $koneksi->query("UPDATE pembelian_obat SET total_pembelian = '$total' WHERE no_pembelian_obat = '$no_pembelian_obat'");
}


// Simpan
if (isset($_POST['tambah'])) {
    $no_pembelian_obat = strip_tags($_POST['no_pembelian_obat']);
    $kode_obat         = strip_tags($_POST['kode_obat']);
    $nama_obat         = strip_tags($_POST['nama_obat']);
    $harga_pembelian   = strip_tags(str_replace(".", "", $_POST['harga_pembelian']));
    $jumlah            = strip_tags($_POST['jumlah']);
    $sub_total         = strip_tags(str_replace(".", "", $_POST['sub_total']));

    $cek = $koneksi->query("SELECT kode_obat FROM detail_pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat' AND kode_obat = '$kode_obat'");
    if ($cek->num_rows > 0) {
        $_SESSION['alert'] = "Kode obat sudah ada";
        $_SESSION['tipe'] = "error";
        echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_pembelian_obat . '">';
    } else {

        $submit = $koneksi->query("INSERT INTO detail_pembelian_obat VALUES (
            null, '$no_pembelian_obat', '$kode_obat', '$nama_obat', '$harga_pembelian', '$jumlah', '$sub_total'
        )");

        if ($submit) {
            // update jumlah stok
            $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok + '$jumlah' WHERE kode_obat = '$kode_obat'");

            // total bayar
            sum_total($no_pembelian_obat, $koneksi);

            $_SESSION['alert'] = "Data Berhasil Disimpan";
            $_SESSION['tipe'] = "success";
            echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_pembelian_obat . '">';
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_detail         = strip_tags($_POST['id_detail']);
        $no_pembelian_obat = strip_tags($_POST['no_pembelian_obat']);
        $jumlah            = strip_tags($_POST['jumlah']);
        $sub_total         = strip_tags(str_replace(".", "", $_POST['sub_total']));

        $cek          = $koneksi->query("SELECT * FROM detail_pembelian_obat WHERE id_detail = '$id_detail'")->fetch_array();
        $cekstok      = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$cek[kode_obat]'")->fetch_array();
        $updatejumlah = ($cekstok['jumlah_stok'] - $cek['jumlah']) + $jumlah;

        $submit = $koneksi->query("UPDATE detail_pembelian_obat SET 
            jumlah = '$jumlah', sub_total = '$sub_total' WHERE id_detail = '$id_detail'
        ");

        if ($submit) {
            $updatestok = $koneksi->query("UPDATE stok_obat SET jumlah_stok = '$updatejumlah' WHERE kode_obat = '$cek[kode_obat]'");

            // total bayar
            sum_total($no_pembelian_obat, $koneksi);

            $_SESSION['alert'] = "Data Berhasil Diubah";
            $_SESSION['tipe']  = "success";
            echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_pembelian_obat . '">';
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $data              = $koneksi->query("SELECT no_pembelian_obat, kode_obat, jumlah FROM detail_pembelian_obat WHERE id_detail = '$_GET[id]'")->fetch_array();

            $no_pembelian_obat = $data['no_pembelian_obat'];
            $kode_obat         = $data['kode_obat'];
            $jumlah            = $data['jumlah'];

            // update jumlah stok
            $updatestok        = $koneksi->query("UPDATE stok_obat SET jumlah_stok = jumlah_stok + '$jumlah' WHERE kode_obat = '$kode_obat'");

            if ($updatestok) {
                // hapus data
                $koneksi->query("DELETE FROM detail_pembelian_obat WHERE id_detail = '$_GET[id]'");

                // total bayar
                sum_total($no_pembelian_obat, $koneksi);

                $_SESSION['alert'] = "Data Berhasil Dihapus";
                $_SESSION['tipe']  = "success";
                echo '<meta http-equiv="refresh" content="0; url=index?id=' . $no_pembelian_obat . '">';
            }
        }
