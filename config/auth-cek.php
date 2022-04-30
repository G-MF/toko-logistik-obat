<?php

if (!isset($_SESSION['username'])) {
    header("location: http://obat-tradisional.test", true, 301);
}
