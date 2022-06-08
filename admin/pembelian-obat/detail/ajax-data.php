<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';

$id   = $_POST['id'];
$data = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$id'")->fetch_array();
$json = [
    'nama_obat'        => $data['nama_obat'],
    'harga_pembelian'  => number_format($data['harga_pembelian'], 0, ',', '.')
];

echo json_encode($json);
