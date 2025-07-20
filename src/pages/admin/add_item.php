<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga_sewa_per_hari'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    $upload_dir = __DIR__ . '/../../img/';
    move_uploaded_file($tmp_name, $upload_dir . $gambar);

    $stmt = $conn->prepare("INSERT INTO items (nama_barang, kategori, deskripsi, harga_sewa_per_hari, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdis", $nama, $kategori, $deskripsi, $harga, $stok, $gambar);
    $stmt->execute();

    header("Location: manage_items.php");
    exit();
}
?>

<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container mt-5">
  <h2>Tambah Produk</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_barang" class="form-label">Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <option value="Kamera">Kamera</option>
        <option value="Lensa">Lensa</option>
        <option value="Aksesoris">Aksesoris</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label for="harga_sewa_per_hari" class="form-label">Harga Sewa/Hari</label>
      <input type="number" name="harga_sewa_per_hari" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="stok" class="form-label">Stok</label>
      <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="manage_items.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
