<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';

$id = $_POST['id'];
$data = $koneksi->query("SELECT * FROM tanaman_obat WHERE id_tanaman = '$id'")->fetch_array();

echo json_encode($data);
