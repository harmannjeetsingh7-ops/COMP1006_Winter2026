<?php
require_once 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Image Gallery App</h1>

<?php if (isLoggedIn()): ?>
    <a href="index.php">Gallery</a> |
    <a href="create.php">Upload</a> |
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a>
<?php endif; ?>

<hr>