<?php
$host = "sql302.infinityfree.com";
$user = "if0_41192176";
$pass = "Rq2pe9TMq5Ad";
$db   = "if0_41192176_blogCMS";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>