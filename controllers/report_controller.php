<?php
include '../config/config.php';

function getReportTransactions($conn) {
    return $conn->query("
        SELECT t.*, c.name as customer_name 
        FROM transactions t 
        LEFT JOIN customers c ON t.customer_id=c.id 
        ORDER BY t.id DESC
    ");
}

function getTotalRevenue($conn) {
    $result = $conn->query("SELECT SUM(total_price) as revenue FROM transactions WHERE status='completed'");
    $data = $result->fetch_assoc();
    return $data['revenue'] ?? 0;
}
