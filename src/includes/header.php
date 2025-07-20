<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/index.php">KAMERA BONTANG</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/src/pages/user/catalog.php">Katalog</a></li>
        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="/src/pages/user/dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="/src/pages/auth/logout.php">Logout</a></li>
        <?php elseif (isset($_SESSION['admin'])): ?>
          <li class="nav-item"><a class="nav-link" href="/src/pages/admin/dashboard.php">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="/src/pages/auth/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/src/pages/auth/login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
