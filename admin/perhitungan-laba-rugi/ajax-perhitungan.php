<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

$trx_penjualan  = $koneksi->query("SELECT tanggal_transaksi, no_nota FROM transaksi_penjualan  WHERE MONTH(tanggal_transaksi) = '$bulan' AND YEAR(tanggal_transaksi) = '$tahun'")->fetch_array();

$trx_pembelian  = $koneksi->query("SELECT SUM(harga_pembelian * jumlah_obat) as total FROM pembelian_obat  WHERE MONTH(tanggal_pembelian) = '$bulan' AND YEAR(tanggal_pembelian) = '$tahun'")->fetch_array();

if ($trx_pembelian) {
    $total_pembelian = rupiah($trx_pembelian['total']);
} else {
    $total_pembelian = 0;
}

if ($trx_penjualan) {
    $data = $koneksi->query("SELECT SUM((harga_jual * banyak_beli) - (harga_pembelian * banyak_beli)) as total FROM detail_transaksi_penjualan WHERE no_nota = '$trx_penjualan[no_nota]'")->fetch_array();
    $total_penjualan = rupiah($data['total']);
} else {
    $total_penjualan = 0;
}

$json = [
    'pembelian' => $total_pembelian,
    'penjualan' => $total_penjualan
];



echo json_encode($json);
