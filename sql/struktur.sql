-- Tabel Admins
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Tabel Users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255)
);

-- Tabel Items (Sudah kamu buat sebelumnya)
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

-- Tabel Orders
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  item_id INT,
  tanggal_sewa DATE,
  durasi_hari INT,
  status ENUM('pending', 'selesai') DEFAULT 'pending',
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (item_id) REFERENCES items(id)
);
