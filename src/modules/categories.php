<?php
include '../config/config.php';
include '../includes/navbar.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM categories WHERE id=$id");
    header('Location: categories.php');
    exit;
}

$result = $conn->query("SELECT * FROM categories");
?>

<div class="container">
    <h2>Manajemen Kategori Produk</h2>
    <a href="category_add.php" class="btn btn-success mb-3">Tambah Kategori</a>
    <table class="table table-bordered">
        <tr>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['category_name'] ?></td>
                <td>
                    <a href="category_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
