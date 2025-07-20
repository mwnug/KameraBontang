<?php
include '../config/config.php';
include '../includes/navbar.php';

// Cek jika belum login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $current = $_POST['current_password'];
    $new     = $_POST['new_password'];
    $id      = $_SESSION['user']['id'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (password_verify($current, $result['password'])) {
        $new_hashed = password_hash($new, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $update->bind_param('si', $new_hashed, $id);
        $update->execute();
        $message = "Password berhasil diperbarui.";
    } else {
        $error = "Password lama salah.";
    }
}
?>

<div class="container">
    <h2>Reset Password</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-success'>$message</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <input type="password" name="current_password" class="form-control mb-2" placeholder="Password Saat Ini" required>
        <input type="password" name="new_password" class="form-control mb-2" placeholder="Password Baru" required>
        <button name="submit" class="btn btn-warning">Reset Password</button>
    </form>
</div>
