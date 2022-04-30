<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';

$id   = $_POST['id'];
$data = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$id'")->fetch_array();
$json = [
    'nama_obat'   => $data['nama_obat'],
    'harga_jual'  => number_format($data['harga_jual'], 0, ',', '.'),
    'jenis_obat'  => $data['jenis_obat'],
    'jumlah_stok' => $data['jumlah_stok'],
];

echo json_encode($json);
