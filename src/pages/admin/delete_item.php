<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar jika perlu
    $stmt = $conn->prepare("SELECT gambar FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item && file_exists(__DIR__ . '/../../img/' . $item['gambar'])) {
        unlink(__DIR__ . '/../../img/' . $item['gambar']);
    }

    // Hapus data
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: manage_items.php");
exit();
