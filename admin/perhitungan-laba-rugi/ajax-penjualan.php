<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$bulan = $_POST['id'];
$tahun = date('Y');
$trx  = $koneksi->query("SELECT tanggal_transaksi, no_nota FROM transaksi_penjualan  WHERE MONTH(tanggal_transaksi) = '$bulan' AND YEAR(tanggal_transaksi) = '$tahun'")->fetch_array();

if ($trx) {
    $data = $koneksi->query("SELECT SUM((harga_jual * banyak_beli) - (harga_pembelian * banyak_beli)) as total FROM detail_transaksi_penjualan WHERE no_nota = '$trx[no_nota]'")->fetch_array();
    $total = rupiah($data['total']);
} else {
    $total = 0;
}

echo json_encode($total);
