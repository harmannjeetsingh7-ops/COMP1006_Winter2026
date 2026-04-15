<?php

session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function e($value) {
    return htmlspecialchars($value);
}

function handleUpload($file) {

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if ($file['error'] !== 0) {
        return false;
    }

    if (!in_array($file['type'], $allowedTypes)) {
        return false;
    }

    $fileName = time() . '_' . $file['name'];
    $uploadPath = 'uploads/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return $uploadPath;
    }

    return false;
}