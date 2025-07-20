<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/admin_login.php");
    exit;
}
require_once "../../config/db.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: items.php");
    exit;
}

$pesan = "";

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    header("Location: items.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Cek apakah ada gambar baru
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $path = "../../img/" . $gambar;
        move_uploaded_file($tmp_name, $path);
    } else {
        $gambar = $item['gambar'];
    }

    $stmt = $conn->prepare("UPDATE items SET nama_barang=?, kategori=?, deskripsi=?, harga_sewa_per_hari=?, stok=?, gambar=? WHERE id=?");
    $stmt->bind_param("sssdisi", $nama, $kategori, $deskripsi, $harga, $stok, $gambar, $id);

    if ($stmt->execute()) {
        $pesan = "Barang berhasil diperbarui!";
        // Refresh item untuk ditampilkan
        $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
    } else {
        $pesan = "Gagal memperbarui barang: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Barang - Admin</title>
  <link rel="stylesheet" href="/src/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h2>Edit Barang</h2>
  <?php if ($pesan): ?>
    <div class="alert alert-info"><?= $pesan ?></div>
  <?php endif; ?>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Barang</label>
      <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($item['nama_barang']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <select name="kategori" class="form-control" required>
        <option value="Kamera" <?= $item['kategori'] == 'Kamera' ? 'selected' : '' ?>>Kamera</option>
        <option value="Lensa" <?= $item['kategori'] == 'Lensa' ? 'selected' : '' ?>>Lensa</option>
        <option value="Aksesoris" <?= $item['kategori'] == 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($item['deskripsi']) ?></textarea>
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga Sewa per Hari</label>
      <input type="number" name="harga" class="form-control" value="<?= $item['harga_sewa_per_hari'] ?>" required>
    </div>
    <div class="mb-3">
      <label for="stok" class="form-label">Stok</label>
      <input type="number" name="stok" class="form-control" value="<?= $item['stok'] ?>" required>
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar (Biarkan kosong jika tidak diubah)</label>
      <input type="file" name="gambar" class="form-control" accept="image/*">
      <img src="/src/img/<?= $item['gambar'] ?>" alt="Gambar" width="120" class="mt-2">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="items.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
