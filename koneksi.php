<?php
$host = "localhost";
$user = "root";
$password = ""; 
$db = "sistem_inventaris_bahan_baku_martabak";


$koneksi = mysqli_connect($host, $user, $password, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
