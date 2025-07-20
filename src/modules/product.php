<?php
include '../config/config.php';
include '../includes/navbar.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header('Location: users.php');
    exit;
}

// Fetch users
$users = $conn->query("SELECT * FROM users");
?>

<div class="container">
    <h2>Manajemen Pengguna</h2>
    <a href="user_add.php" class="btn btn-success mb-3">Tambah User</a>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
        </tr>
        <?php while ($u = $users->fetch_assoc()) { ?>
            <tr>
                <td><?= $u['name'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <a href="user_edit.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
