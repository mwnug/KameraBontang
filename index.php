<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>KAMERA BONTANG</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/src/css/style.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/index.php">KAMERA BONTANG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/src/pages/user/catalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="/src/pages/auth/login.php">Login User</a></li>
          <li class="nav-item"><a class="nav-link" href="/src/pages/auth/admin_login.php">Login Admin</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <main class="container mt-5">
    <h1 class="text-center">Selamat Datang di KAMERA BONTANG</h1>
    <p class="text-center">Sewa kamera, lensa, dan aksesoris dengan mudah dan cepat!</p>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    &copy; 2025 UMKM Kamera Bontang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
