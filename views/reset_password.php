<?php
session_start();
include '../config/config.php';
include '../controllers/auth_controller.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $user = $_SESSION['user'];

    // Ambil data password saat ini
    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($current_password, $result['password'])) {
        $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $new_hashed, $user['id']);
        $stmt->execute();
        $success = "Password berhasil diubah.";
    } else {
        $error = "Password lama tidak cocok.";
    }
}

include '../includes/header.php';
?>

<h3>Reset Password</h3>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php elseif (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <input type="password" name="current_password" class="form-control" placeholder="Password Lama" required>
    </div>
    <div class="mb-3">
        <input type="password" name="new_password" class="form-control" placeholder="Password Baru" required>
    </div>
    <button type="submit" class="btn btn-primary">Ganti Password</button>
</form>

<?php include '../includes/footer.php'; ?>
