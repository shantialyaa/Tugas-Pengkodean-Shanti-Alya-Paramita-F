-- Membuat database
CREATE DATABASE perpustakaan;
USE perpustakaan;

-- Tabel kategori
CREATE TABLE kategori (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(50) NOT NULL,
    deskripsi TEXT
);

-- Tabel buku
CREATE TABLE buku (
    id_buku INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(100) NOT NULL,
    penulis VARCHAR(50) NOT NULL,
    penerbit VARCHAR(50),
    tahun_terbit YEAR,
    id_kategori INT,
    stok INT NOT NULL DEFAULT 0,
    isbn VARCHAR(20),
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE SET NULL
);

-- Tabel anggota
CREATE TABLE anggota (
    id_anggota INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    alamat TEXT,
    no_telepon VARCHAR(15),
    email VARCHAR(50),
    tanggal_daftar DATE NOT NULL,
    status_aktif BOOLEAN DEFAULT TRUE
);

-- Tabel petugas
CREATE TABLE petugas (
    id_petugas INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50),
    no_telepon VARCHAR(15)
);

-- Tabel peminjaman
CREATE TABLE peminjaman (
    id_peminjaman INT PRIMARY KEY AUTO_INCREMENT,
    id_anggota INT,
    id_buku INT,
    id_petugas INT,
    tanggal_pinjam DATE NOT NULL,
    tanggal_jatuh_tempo DATE NOT NULL,
    status_peminjaman ENUM('dipinjam', 'dikembalikan') DEFAULT 'dipinjam',
    FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota) ON DELETE CASCADE,
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku) ON DELETE CASCADE,
    FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas) ON DELETE SET NULL
);

-- Tabel pengembalian
CREATE TABLE pengembalian (
    id_pengembalian INT PRIMARY KEY AUTO_INCREMENT,
    id_peminjaman INT,
    id_petugas INT,
    tanggal_kembali DATE NOT NULL,
    FOREIGN KEY (id_peminjaman) REFERENCES peminjaman(id_peminjaman) ON DELETE CASCADE,
    FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas) ON DELETE SET NULL
);

-- Tabel denda
CREATE TABLE denda (
    id_denda INT PRIMARY KEY AUTO_INCREMENT,
    id_peminjaman INT,
    jumlah_denda DECIMAL(10,2) NOT NULL,
    status_pembayaran ENUM('belum_lunas', 'lunas') DEFAULT 'belum_lunas',
    tanggal_denda DATE NOT NULL,
    FOREIGN KEY (id_peminjaman) REFERENCES peminjaman(id_peminjaman) ON DELETE CASCADE
);