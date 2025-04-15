USE inventory;

CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(255) NOT NULL,
    stok INT NOT NULL,
    harga INT NOT NULL
);
