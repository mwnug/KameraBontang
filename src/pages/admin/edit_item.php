<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    echo "Data tidak ditemukan!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga_sewa_per_hari'];
    $stok = $_POST['stok'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $upload_dir = __DIR__ . '/../../img/';
        move_uploaded_file($tmp_name, $upload_dir . $gambar);
    } else {
        $gambar = $item['gambar'];
    }

    $stmt = $conn->prepare("UPDATE items SET nama_barang=?, kategori=?, deskripsi=?, harga_sewa_per_hari=?, stok=?, gambar=? WHERE id=?");
    $stmt->bind_param("sssdssi", $nama, $kategori, $deskripsi, $harga, $stok, $gambar, $id);
    $stmt->execute();

    header("Location: manage_items.php");
    exit();
}
?>

<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container mt-5">
  <h2>Edit Produk</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($item['nama_barang']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <option value="Kamera" <?= $item['kategori'] == 'Kamera' ? 'selected' : '' ?>>Kamera</option>
        <option value="Lensa" <?= $item['kategori'] == 'Lensa' ? 'selected' : '' ?>>Lensa</option>
        <option value="Aksesoris" <?= $item['kategori'] == 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($item['deskripsi']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga Sewa/Hari</label>
      <input type="number" name="harga_sewa_per_hari" class="form-control" value="<?= $item['harga_sewa_per_hari'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input type="number" name="stok" class="form-control" value="<?= $item['stok'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Upload Gambar (kosongkan jika tidak ingin ganti)</label>
      <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="manage_items.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
