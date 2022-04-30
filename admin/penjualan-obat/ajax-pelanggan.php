<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$id   = $_POST['id'];
$data = $koneksi->query("SELECT nama_pelanggan, no_hp, alamat FROM pelanggan WHERE kode_pelanggan = '$id'")->fetch_array();

echo json_encode($data);
