<?php
include '../config/config.php';

function getAllProducts($conn) {
    return $conn->query("SELECT p.*, c.category_name FROM products p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.id DESC");
}

function getProductById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function addProduct($conn, $name, $price, $stock, $category_id) {
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, category_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $name, $price, $stock, $category_id);
    return $stmt->execute();
}

function updateProduct($conn, $id, $name, $price, $stock, $category_id) {
    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, category_id=? WHERE id=?");
    $stmt->bind_param("siiii", $name, $price, $stock, $category_id, $id);
    return $stmt->execute();
}

function deleteProduct($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
