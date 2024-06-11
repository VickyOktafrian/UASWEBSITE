<?php
session_start();

function checkAuthentication() {
    if (!isset($_SESSION['admin_username']) || !isset($_SESSION['admin_email'])) {
        redirectToLogin();
    }

    $username = $_SESSION['admin_username'];
    $email = $_SESSION['admin_email'];

    $query = "SELECT * FROM admin WHERE username = ? AND email = ?";
    $params = [$username, $email];
    $result = readRecords($query, $params);

    if (empty($result)) {
        redirectToLogin();
    }
}

function redirectToLogin() {
    header("Location: ../masuk.php");
    exit();
}
?>
