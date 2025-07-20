<?php
session_start();
include '../config/config.php';
include '../controllers/auth_controller.php';
checkLogin();
include '../includes/header.php';
?>

<h1>Selamat Datang, <?= $_SESSION['user']['name'] ?>!</h1>
<p>Anda login sebagai <strong><?= $_SESSION['user']['role'] ?></strong>.</p>

<?php include '../includes/footer.php'; ?>
