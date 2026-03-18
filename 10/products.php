<?php
//challenge students to create independently initially */ 
require "includes/connect.php";
require "includes/header.php";

// Get all products, newest first
//set up the SQL query
$sql = "SELECT * FROM products ORDER BY created_at DESC";
//prepare the statement
$stmt = $pdo->prepare($sql);
//execute the statement
$stmt->execute();
//fetch all the results as an associative array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container mt-4">
    <h1 class="mb-4">Our Products</h1>

</main>

<?php require "includes/footer.php"; ?>