<?php 
include '../../includes/header.php';
include '../../controllers/user_controller.php';

$id = $_GET['id'];
$user = getUserById($conn, $id);

if (isset($_POST['submit'])) {
    updateUser($conn, $id, $_POST['name'], $_POST['role']);
    header('Location: list.php');
}
?>

<h3>Edit User</h3>
<form method="POST">
    <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control mb-2" required>
    <select name="role" class="form-control mb-2">
        <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
        <option value="staff" <?= ($user['role'] == 'staff') ? 'selected' : '' ?>>Staff</option>
    </select>
    <button name="submit" class="btn btn-primary">Update</button>
</form>

<?php include '../../includes/footer.php'; ?>
