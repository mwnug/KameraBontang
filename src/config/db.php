<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'rental_kamera';

$conn = new mysqli($host, $user, $pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
