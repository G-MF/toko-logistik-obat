<?php
require_once '../../config/config.php';

$id = $_POST['id'];
$data = $koneksi->query("SELECT * FROM obat WHERE id_obat = '$id'")->fetch_array();

echo json_encode($data);
