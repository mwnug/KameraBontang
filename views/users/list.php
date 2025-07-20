<?php include '../../includes/header.php'; ?>

<!-- Konten halaman di sini -->

<?php include '../../includes/footer.php'; ?>
<?php 
include '../../includes/header.php';
include '../../controllers/user_controller.php';

$users = getAllUsers($conn);
?>

<h3>Manajemen Pengguna</h3>
<a href="add.php" class="btn btn-success mb-3">Tambah User</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
    </tr>
    <?php while ($user = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['role'] ?></td>
        <td>
            <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../../includes/footer.php'; ?>
