<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /src/pages/auth/login.php");
  exit;
}
?>
