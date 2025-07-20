<?php 
include '../../includes/header.php';
include '../../controllers/user_controller.php';

if (isset($_POST['submit'])) {
    addUser($conn, $_POST['name'], $_POST['email'], $_POST['password'], $_POST['role']);
    header('Location: list.php');
}
?>

<h3>Tambah User</h3>
<form method="POST">
    <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
    <select name="role" class="form-control mb-2">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select>
    <button name="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>
