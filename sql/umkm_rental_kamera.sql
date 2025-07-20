
-- Database: umkm_rental_kamera

CREATE DATABASE IF NOT EXISTS umkm_rental_kamera;
USE umkm_rental_kamera;

-- Tabel pengguna
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel kategori produk
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT
);

-- Tabel produk (kamera, lensa, aksesoris)
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100),
    kategori_id INT,
    deskripsi TEXT,
    harga_sewa DECIMAL(10,2),
    stok INT DEFAULT 0,
    gambar VARCHAR(255),
    FOREIGN KEY (kategori_id) REFERENCES kategori(id)
);

-- Tabel pelanggan (user bisa menyewa)
CREATE TABLE pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    alamat TEXT,
    no_hp VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabel transaksi peminjaman
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pelanggan_id INT,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    total_harga DECIMAL(10,2),
    status ENUM('pending','disewa','dikembalikan') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

-- Tabel detail transaksi (produk yang disewa)
CREATE TABLE detail_transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,
    produk_id INT,
    jumlah INT,
    harga DECIMAL(10,2),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (produk_id) REFERENCES produk(id)
);

-- Tabel pembayaran
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,
    metode_pembayaran VARCHAR(50),
    jumlah_bayar DECIMAL(10,2),
    bukti_transfer VARCHAR(255),
    status ENUM('belum dibayar', 'dibayar') DEFAULT 'belum dibayar',
    tanggal_bayar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

-- Tabel log aktivitas user
CREATE TABLE aktivitas_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    aktivitas TEXT,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabel pengaturan sistem
CREATE TABLE pengaturan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengaturan VARCHAR(100),
    nilai TEXT
);

-- Tabel ulasan produk
CREATE TABLE ulasan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produk_id INT,
    user_id INT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    komentar TEXT,
    tanggal_ulasan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produk_id) REFERENCES produk(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
