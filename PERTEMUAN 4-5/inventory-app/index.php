<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory App</title>
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
            max-width: 900px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .btn {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .btn-green { background-color: #28a745; color: white; }
        .btn-green:hover { background-color: #218838; }
        .btn-red { background-color: #dc3545; color: white; }
        .btn-red:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container text-white p-6">
        <h2 class="text-center text-3xl font-bold mb-6">📦 Inventory Management</h2>

        <!-- Statistik -->
        <div class="grid grid-cols-3 gap-4 mb-6 text-center">
            <?php
            include 'config.php';
            $result = $conn->query("SELECT COUNT(*) AS total_produk, SUM(stok) AS total_stok, SUM(stok * harga) AS total_nilai FROM barang");
            $data = $result->fetch_assoc();
            ?>
            <div class="p-4 bg-white bg-opacity-20 rounded-lg">
                <h3 class="text-xl font-semibold">Total Produk</h3>
                <p class="text-2xl"><?= $data['total_produk'] ?: 0; ?></p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-lg">
                <h3 class="text-xl font-semibold">Total Stok</h3>
                <p class="text-2xl"><?= $data['total_stok'] ?: 0; ?></p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-lg">
                <h3 class="text-xl font-semibold">Total Nilai</h3>
                <p class="text-2xl">Rp <?= number_format($data['total_nilai'] ?: 0, 0, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-white border-collapse">
                <thead>
                    <tr class="bg-white bg-opacity-20">
                        <th class="p-3">ID</th>
                        <th class="p-3">Nama Barang</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM barang");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='text-center hover:bg-white hover:bg-opacity-30 transition'>
                                <td class='p-3'>{$row['id']}</td>
                                <td class='p-3'>{$row['nama_barang']}</td>
                                <td class='p-3'>{$row['stok']}</td>
                                <td class='p-3 text-green-300 font-semibold'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                <td class='p-3'>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-green'>✏️ Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='btn btn-red ml-3' onclick='return confirm(\"Hapus data ini?\")'>🗑️ Hapus</a>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol Tambah -->
        <div class="mt-6 text-center">
            <a href="add.php" class="btn btn-green">+ Tambah Barang</a>
        </div>
    </div>
</body>
</html>
