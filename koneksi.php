<?php
$host = '';
$user = '';
$pass = '';
$db = 'db_showroommobil';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
