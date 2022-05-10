<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';

$id   = $_POST['id'];
$data = $koneksi->query("SELECT * FROM detail_transaksi_penjualan WHERE id_detail = '$id'")->fetch_array();
$stok = $koneksi->query("SELECT jumlah_stok FROM stok_obat WHERE kode_obat = '$data[kode_obat]'")->fetch_array();

$json = [
    'id_detail'       => $data['id_detail'],
    'no_nota'         => $data['no_nota'],
    'kode_obat'       => $data['kode_obat'],
    'nama_obat'       => $data['nama_obat'],
    'harga_jual'      => number_format($data['harga_jual'], 0, ',', '.'),
    'jenis_obat'      => $data['jenis_obat'],
    'jumlah_stok'     => $data['banyak_beli'] + $stok['jumlah_stok'],
    'banyak_beli'     => $data['banyak_beli'],
    'sub_total'       => number_format($data['sub_total'], 0, ',', '.'),
];

echo json_encode($json);
