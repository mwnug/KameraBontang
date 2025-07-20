<?php
require_once '../../config/db.php';
session_start();

// Ambil semua item dari database
$query = "SELECT * FROM items ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Katalog Kamera</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/src/css/style.css">
</head>
<body>

<?php include_once '../../includes/header.php'; ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Katalog Kamera, Lensa & Aksesoris</h2>
  <div class="row">

    <?php while($item = $result->fetch_assoc()): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="/src/img/<?= $item['gambar']; ?>" class="card-img-top" alt="<?= $item['nama_barang']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $item['nama_barang']; ?></h5>
            <p class="card-text"><?= $item['deskripsi']; ?></p>
            <p><strong>Harga Sewa:</strong> Rp<?= number_format($item['harga_sewa_per_hari'], 0, ',', '.'); ?>/hari</p>
            <p><strong>Stok:</strong> <?= $item['stok']; ?></p>
          </div>
          <div class="card-footer text-center">
            <a href="https://wa.me/6281234567890?text=Saya%20ingin%20menyewa%20<?= urlencode($item['nama_barang']); ?>" class="btn btn-success" target="_blank">Sewa via WhatsApp</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>

  </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
