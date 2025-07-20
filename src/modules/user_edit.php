<?php
include '../config/config.php';
include '../includes/navbar.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$data = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET name=?, role=? WHERE id=?");
    $stmt->bind_param('ssi', $name, $role, $id);
    $stmt->execute();

    header('Location: users.php');
    exit;
}
?>

<div class="container">
    <h2>Edit User</h2>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" value="<?= $data['name'] ?>" required>
        <select name="role" class="form-control mb-2">
            <option value="admin" <?= $data['role']=='admin'?'selected':'' ?>>Admin</option>
            <option value="staff" <?= $data['role']=='staff'?'selected':'' ?>>Staff</option>
        </select>
        <button name="submit" class="btn btn-primary">Update</button>
    </form>
</div>
