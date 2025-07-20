<?php
include '../config/config.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h1>Dashboard Rental Kamera</h1>
    <p>Halo, <?= $_SESSION['user']['name']; ?>!</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
