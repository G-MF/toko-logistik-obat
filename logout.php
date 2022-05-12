<?php
session_start();

unset($_SESSION['id_admin']);
unset($_SESSION['username']);
unset($_SESSION['level']);

session_unset();
session_destroy();

// header("location: http://toko-logistik-obat.test", true, 301);
header("location: http://localhost/toko-logistik-obat", true, 301);
