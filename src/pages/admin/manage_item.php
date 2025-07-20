<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';
include_once __DIR__ . '/../../includes/header.php';

// Hapus item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM items WHERE id = $id");
    header("Location: manage_items.php");
    exit();
}

// Ambil semua data
$items = $conn->query("SELECT * FROM items");
?>

<div class="container mt-5">
  <h2>Manajemen Katalog</h2>
  <a href="add_item.php" class="btn btn-primary mb-3">+ Tambah Produk</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga/Hari</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $items->fetch_assoc()) : ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
        <td><?= $row['kategori'] ?></td>
        <td>Rp<?= number_format($row['harga_sewa_per_hari'], 0, ',', '.') ?></td>
        <td><?= $row['stok'] ?></td>
        <td>
          <a href="edit_item.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
