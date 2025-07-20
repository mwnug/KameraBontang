<?php
include '../config/config.php';
include '../includes/navbar.php';

$id = $_GET['id'];
$row = $conn->query("SELECT * FROM categories WHERE id=$id")->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = $_POST['category_name'];
    $stmt = $conn->prepare("UPDATE categories SET category_name=? WHERE id=?");
    $stmt->bind_param('si', $name, $id);
    $stmt->execute();
    header('Location: categories.php');
    exit;
}
?>

<div class="container">
    <h2>Edit Kategori</h2>
    <form method="POST">
        <input type="text" name="category_name" class="form-control mb-2" value="<?= $row['category_name'] ?>" required>
        <button name="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<a href="categories.php" class="btn btn-outline-light mx-2">Kategori Produk</a>
<a href="reset_password.php" class="btn btn-outline-light mx-2">Reset Password</a>
