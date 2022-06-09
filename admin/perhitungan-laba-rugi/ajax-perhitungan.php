<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

$trx_penjualan  = $koneksi->query("SELECT SUM(total_bayar) as total FROM transaksi_penjualan  WHERE MONTH(tanggal_transaksi) = '$bulan' AND YEAR(tanggal_transaksi) = '$tahun'")->fetch_array();

$trx_pembelian  = $koneksi->query("SELECT SUM(total_pembelian) as total FROM pembelian_obat  WHERE MONTH(tanggal_pembelian) = '$bulan' AND YEAR(tanggal_pembelian) = '$tahun'")->fetch_array();

if ($trx_pembelian) {
    $total_pembelian = number_format($trx_pembelian['total'], 0, ',', '.');
} else {
    $total_pembelian = 0;
}

if ($trx_penjualan) {
    $total_penjualan = number_format($trx_penjualan['total'], 0, ',', '.');
} else {
    $total_penjualan = 0;
}

$json = [
    'pembelian' => $total_pembelian,
    'penjualan' => $total_penjualan
];



echo json_encode($json);
