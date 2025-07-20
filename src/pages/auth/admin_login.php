<?php
session_start();
require_once '../../config/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: ../admin/dashboard.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Admin tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel="stylesheet" href="/src/css/style.css">
</head>
<body>
  <div class="login-container">
    <h2>Login Admin</h2>
    <?php if (isset($error)): ?>
      <p class="error"><?= $error; ?></p>
    <?php endif; ?>
    <form method="POST">
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</body>
</html>
