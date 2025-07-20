<?php
include '../config/config.php';
include '../includes/navbar.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $name, $email, $password, $role);
    $stmt->execute();

    header('Location: users.php');
    exit;
}
?>

<div class="container">
    <h2>Tambah User</h2>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <select name="role" class="form-control mb-2">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
        </select>
        <button name="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
