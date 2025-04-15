<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Kosongkan jika pakai XAMPP
$dbname = 'inventory'; // Sesuaikan dengan nama database kamu

// Buat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
