<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/admin_login.php");
    exit;
}

require_once "../../config/db.php";

$id = $_GET['id'] ?? null;
if ($id) {
    // Hapus gambar terlebih dahulu jika ada
    $stmt = $conn->prepare("SELECT gambar FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item && !empty($item['gambar']) && file_exists("../../img/" . $item['gambar'])) {
        unlink("../../img/" . $item['gambar']);
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: items.php");
exit;
