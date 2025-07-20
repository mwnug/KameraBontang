<?php
include '../config/config.php';
include '../includes/navbar.php';
include '../controllers/user_controller.php';

$users = getAllUsers($conn);
?>

<div class="container">
    <h2>Daftar Pengguna</h2>
    <a href="user_add.php" class="btn btn-success mb-3">Tambah User</a>
    <table class="table table-striped">
        <tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
        <?php while ($u = $users->fetch_assoc()) { ?>
            <tr>
                <td><?= $u['name'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <a href="user_edit.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $u['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

