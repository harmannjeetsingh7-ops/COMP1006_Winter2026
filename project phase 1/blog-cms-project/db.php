<?php
// COMP1006 - Phase One Project
// Database Connection File

$host = "sql302.infinityfree.com";
$user = "if0_41192176";
$pass = "Rq2pe9TMq5Ad";
$db   = "if0_41192176_blogCMS";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>