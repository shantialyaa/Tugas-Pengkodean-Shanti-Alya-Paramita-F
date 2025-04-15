<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Query menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO barang (nama_barang, stok, harga) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $nama_barang, $stok, $harga);

    if ($stmt->execute()) {
        echo "<script>alert('Barang berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan barang.'); window.location='add.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Akses tidak diizinkan!'); window.location='index.php';</script>";
}
?>
