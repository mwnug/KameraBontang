<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once "../../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga_sewa_per_hari'];
    $stok = $_POST['stok'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../../img/" . $gambar);

    $sql = "INSERT INTO items (nama_barang, kategori, deskripsi, harga_sewa_per_hari, stok, gambar)
            VALUES ('$nama', '$kategori', '$deskripsi', '$harga', '$stok', '$gambar')";
    $conn->query($sql);
    header("Location: manage_items.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Item</title>
    <link rel="stylesheet" href="/src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h3>Tambah Item</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-2">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="Kamera">Kamera</option>
                <option value="Lensa">Lensa</option>
                <option value="Aksesoris">Aksesoris</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-2">
            <label>Harga Sewa per Hari</label>
            <input type="number" name="harga_sewa_per_hari" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Upload Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="manage_items.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
