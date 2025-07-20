<?php
include '../config/config.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
include '../includes/navbar.php';
?>

<div class="container">
    <h1>Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">Total Produk</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">Total Transaksi</div>
            </div>
        </div>
    </div>
</div>
