<?php
session_start();
require_once '../../config/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../user/catalog.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Akun tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Pengguna</title>
  <link rel="stylesheet" href="/src/css/style.css">
</head>
<body>
  <div class="login-container">
    <h2>Login Pengguna</h2>
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
