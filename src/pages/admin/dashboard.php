<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';
include_once __DIR__ . '/../../includes/header.php';

// Hitung total data
$total_items = $conn->query("SELECT COUNT(*) AS total FROM items")->fetch_assoc()['total'];
$total_orders = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
?>

<div class="container mt-5">
  <h2>Dashboard Admin</h2>
  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card bg-info text-white">
        <div class="card-body">
          <h4 class="card-title">Total Produk</h4>
          <p class="card-text fs-2"><?= $total_items ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h4 class="card-title">Total Order</h4>
          <p class="card-text fs-2"><?= $total_orders ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-warning text-dark">
        <div class="card-body">
          <h4 class="card-title">Total User</h4>
          <p class="card-text fs-2"><?= $total_users ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
