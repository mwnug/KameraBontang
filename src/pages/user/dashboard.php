<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /src/pages/auth/login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';
include_once __DIR__ . '/../../includes/header.php';

$user_id = $_SESSION['user']['id'];
$sql = "SELECT o.*, i.nama_barang, i.gambar FROM orders o 
        JOIN items i ON o.item_id = i.id 
        WHERE o.user_id = $user_id 
        ORDER BY o.created_at DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5">
  <h2 class="mb-4">Dashboard Pengguna</h2>

  <h4>Riwayat Penyewaan Anda</h4>
  <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Tanggal Sewa</th>
            <th>Lama Sewa</th>
            <th>Kontak</th>
            <th>Waktu Pemesanan</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><img src="/src/img/<?= $row['gambar'] ?>" width="60"></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['tanggal_sewa'] ?></td>
            <td><?= $row['durasi'] ?> hari</td>
            <td><?= $row['kontak'] ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p>Belum ada penyewaan yang dilakukan.</p>
  <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
