<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';

$id = $_POST['id'];
$data = $koneksi->query("SELECT * FROM stok_obat WHERE kode_obat = '$id'")->fetch_array();

echo json_encode($data);
