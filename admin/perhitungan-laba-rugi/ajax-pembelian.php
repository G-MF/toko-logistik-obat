<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$bulan = $_POST['id'];
$tahun = date('Y');
$trx  = $koneksi->query("SELECT SUM(harga_pembelian * jumlah_obat) as total FROM pembelian_obat  WHERE MONTH(tanggal_pembelian) = '$bulan' AND YEAR(tanggal_pembelian) = '$tahun'")->fetch_array();

if ($trx) {
    $total = rupiah($trx['total']);
} else {
    $total = 0;
}

echo json_encode($total);
