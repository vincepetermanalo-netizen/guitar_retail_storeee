<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin($loginPath = 'login.php') {
    if (!isLoggedIn()) {
        header("Location: " . $loginPath);
        exit;
    }
}

function flashMessage() {
    if (isset($_SESSION['message'])) {
        echo '<p>' . htmlspecialchars($_SESSION['message']) . '</p>';
        unset($_SESSION['message']);
    }
}