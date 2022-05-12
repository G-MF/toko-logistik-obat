<?php
function base_url($url = null)
{
    // $base_url = "http://toko-logistik-obat.test";
    $base_url = "http://localhost/toko-logistik-obat";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}

function page_active($page_now)
{
    $url =  $_SERVER['REQUEST_URI'];
    $ex  = explode('/', $url);
    $co  = count($ex);
    $page = $ex[$co - 2];

    if ($page == $page_now) {
        return 'active';
    }
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function rupiah($nilai)
{
    return "Rp. " . number_format($nilai, 0, ',', '.');
}

// KONEKSI DATABASE
$host = "localhost";
$user = "root";
$password = "";
$name = "toko_logistik_obat";

$koneksi = mysqli_connect($host, $user, $password, $name);

if (!$koneksi) {
    die("Gagal Terkoneksi" . mysqli_connect_errno() . " - " . mysqli_connect_error());
    exit();
}

// ZONA WAKTU INDONESIA
date_default_timezone_set('Asia/Makassar');

session_start();
$no = 1;
