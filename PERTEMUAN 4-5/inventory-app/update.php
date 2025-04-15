<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Pastikan data sudah benar
    if (empty($nama_barang) || $stok < 0 || $harga < 0) {
        die("Data tidak valid.");
    }

    $query = $conn->prepare("UPDATE barang SET nama_barang=?, stok=?, harga=? WHERE id=?");
    $query->bind_param("siii", $nama_barang, $stok, $harga, $id);

    if ($query->execute()) {
        header("Location: index.php?pesan=update_sukses");
    } else {
        echo "Gagal mengupdate barang!";
    }
}
?>
