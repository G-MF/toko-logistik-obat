<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';

$id   = $_POST['id'];
$data = $koneksi->query("SELECT * FROM detail_pembelian_obat WHERE id_detail = '$id'")->fetch_array();

$json = [
    'id_detail'         => $data['id_detail'],
    'no_pembelian_obat' => $data['no_pembelian_obat'],
    'kode_obat'         => $data['kode_obat'],
    'nama_obat'         => $data['nama_obat'],
    'harga_pembelian'   => number_format($data['harga_pembelian'], 0, ',', '.'),
    'jumlah'            => $data['jumlah'],
    'sub_total'         => number_format($data['sub_total'], 0, ',', '.'),
];

echo json_encode($json);
