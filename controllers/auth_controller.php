<?php
function login($conn, $email, $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['user'] = $result;
        return true;
    }
    return false;
}

function checkLogin() {
    if (!isset($_SESSION['user'])) {
        header('Location: /views/login.php');
        exit;
    }
}

function logout() {
    session_start();
    session_destroy();
    header('Location: /views/login.php');
    exit;
}

// Logout handler
if (isset($_GET['logout'])) {
    logout();
}
?>
