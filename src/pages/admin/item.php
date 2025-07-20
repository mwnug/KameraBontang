<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/admin_login.php");
    exit;
}
require_once "../../config/db.php";

// Ambil semua item
$result = $conn->query("SELECT * FROM items ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Katalog - Kamera Bontang</title>
  <link rel="stylesheet" href="/src/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Kelola Katalog Barang</h2>
  <a href="item_add.php" class="btn btn-primary mb-3">+ Tambah Barang</a>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
        <td><?= $row['kategori'] ?></td>
        <td>Rp<?= number_format($row['harga_sewa_per_hari']) ?>/hari</td>
        <td><?= $row['stok'] ?></td>
        <td><img src="/src/img/<?= $row['gambar'] ?>" width="60"></td>
        <td>
          <a href="item_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a <a href="item_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>
</body>
</html>
