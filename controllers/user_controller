<?php
function getAllUsers($conn) {
    return $conn->query("SELECT * FROM users");
}

function getUserById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function addUser($conn, $name, $email, $password, $role) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hash, $role);
    $stmt->execute();
}

function updateUser($conn, $id, $name, $role) {
    $stmt = $conn->prepare("UPDATE users SET name=?, role=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $role, $id);
    $stmt->execute();
}

function deleteUser($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>
