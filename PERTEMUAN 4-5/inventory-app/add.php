<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
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
            max-width: 400px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .btn {
            width: 48%;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.2s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <div class="container text-white p-6">
        <h2 class="text-center text-2xl font-bold mb-6">➕ Tambah Barang</h2>

        <form action="proses_add.php" method="POST">
            <div class="mb-4">
                <label class="block text-sm mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" required class="w-full p-3 rounded bg-white bg-opacity-20 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-2">Stok</label>
                <input type="number" name="stok" required class="w-full p-3 rounded bg-white bg-opacity-20 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-2">Harga</label>
                <input type="number" name="harga" required class="w-full p-3 rounded bg-white bg-opacity-20 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="btn bg-green-500 text-white hover:bg-green-600">✔ Simpan</button>
                <a href="index.php" class="btn bg-red-500 text-white text-center hover:bg-red-600">✖ Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
