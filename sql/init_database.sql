CREATE DATABASE IF NOT EXISTS db_rental_kamera;
USE db_rental_kamera;

-- Admins
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Items (Kamera, Lensa, Aksesoris)
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100),
    kategori ENUM('Kamera', 'Lensa', 'Aksesoris') NOT NULL,
    deskripsi TEXT,
    harga_sewa_per_hari DECIMAL(10,2),
    stok INT,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item_id INT,
    tanggal_sewa DATE,
    durasi INT,
    total DECIMAL(10,2),
    status ENUM('pending','approved','returned') DEFAULT 'pending',
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(item_id) REFERENCES items(id)
);
