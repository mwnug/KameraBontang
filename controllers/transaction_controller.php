<?php
include '../config/config.php';

function getAllTransactions($conn) {
    return $conn->query("
        SELECT t.*, c.name as customer_name 
        FROM transactions t 
        LEFT JOIN customers c ON t.customer_id=c.id 
        ORDER BY t.id DESC
    ");
}

function getTransactionById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM transactions WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function confirmTransaction($conn, $id) {
    $stmt = $conn->prepare("UPDATE transactions SET status='active' WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
