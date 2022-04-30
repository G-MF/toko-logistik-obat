<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$id   = $_POST['id'];
$data = $koneksi->query("SELECT nama_supplier FROM supplier WHERE kode_supplier = '$id'")->fetch_array();

echo json_encode($data);
