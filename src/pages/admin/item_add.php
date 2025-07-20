<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/admin_login.php");
    exit;
}
require_once "../../config/db.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    // Simpan gambar ke folder img
    $path = "../../img/" . $gambar;
    move_uploaded_file($tmp_name, $path);

    $stmt = $conn->prepare("INSERT INTO items (nama_barang, kategori, deskripsi, harga_sewa_per_hari, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdis", $nama, $kategori, $deskripsi, $harga, $stok, $gambar);

    if ($stmt->execute()) {
        $pesan = "Barang berhasil ditambahkan!";
    } else {
        $pesan = "Gagal menambahkan barang: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang - Admin</title>
  <link rel="stylesheet" href="/src/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h2>Tambah Barang Baru</h2>
  <?php if ($pesan): ?>
    <div class="alert alert-info"><?= $pesan ?></div>
  <?php endif; ?>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Barang</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <select name="kategori" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="Kamera">Kamera</option>
        <option value="Lensa">Lensa</option>
        <option value="Aksesoris">Aksesoris</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga Sewa per Hari</label>
      <input type="number" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="stok" class="form-label">Stok</label>
      <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input type="file" name="gambar" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah</button>
    <a href="items.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
