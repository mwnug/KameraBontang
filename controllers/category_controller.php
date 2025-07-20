<?php
include '../config/config.php';

// Fungsi untuk mengambil semua kategori
function getAllCategories($conn) {
    $result = $conn->query("SELECT * FROM categories ORDER BY category_name ASC");
    return $result;
}

// Fungsi untuk mengambil satu kategori berdasarkan ID
function getCategoryById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Fungsi untuk menambahkan kategori baru
function addCategory($conn, $category_name) {
    $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);
    return $stmt->execute();
}

// Fungsi untuk mengupdate kategori
function updateCategory($conn, $id, $category_name) {
    $stmt = $conn->prepare("UPDATE categories SET category_name=? WHERE id=?");
    $stmt->bind_param("si", $category_name, $id);
    return $stmt->execute();
}

// Fungsi untuk menghapus kategori
function deleteCategory($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM categories WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
