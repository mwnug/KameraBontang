<?php
include '../config/config.php';
include '../includes/navbar.php';

if (isset($_POST['submit'])) {
    $name = $_POST['category_name'];
    $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    header('Location: categories.php');
    exit;
}
?>

<div class="container">
    <h2>Tambah Kategori</h2>
    <form method="POST">
        <input type="text" name="category_name" class="form-control mb-2" placeholder="Nama Kategori" required>
        <button name="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
