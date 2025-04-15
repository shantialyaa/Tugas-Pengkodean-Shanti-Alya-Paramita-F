<?php
include 'config.php';

// Pastikan ID ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID barang tidak ditemukan.");
}

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM barang WHERE id = $id");

if ($query->num_rows == 0) {
    die("Barang tidak ditemukan.");
}

$row = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6A11CB, #2575FC);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn {
            transition: 0.3s;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container text-white p-6">
    <h2 class="text-center text-2xl font-bold mb-4">✏️ Edit Barang</h2>
    
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label class="block mb-2">Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($row['nama_barang']) ?>" 
               class="w-full px-3 py-2 mb-3 rounded-lg text-black" required>

        <label class="block mb-2">Stok:</label>
        <input type="number" name="stok" value="<?= $row['stok'] ?>" 
               class="w-full px-3 py-2 mb-3 rounded-lg text-black" required>

        <label class="block mb-2">Harga:</label>
        <input type="number" name="harga" value="<?= $row['harga'] ?>" 
               class="w-full px-3 py-2 mb-3 rounded-lg text-black" required>

        <div class="mt-4 text-center">
            <button type="submit" class="btn bg-green-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-green-600">💾 Simpan</button>
            <a href="index.php" class="btn bg-red-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-red-600 ml-2">❌ Batal</a>
        </div>
    </form>
</div>

</body>
</html>
