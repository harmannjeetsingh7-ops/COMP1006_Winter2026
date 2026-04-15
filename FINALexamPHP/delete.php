<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

requireLogin();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM images WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $img = $stmt->fetch();

    if ($img) {

        if (file_exists($img['image_path'])) {
            unlink($img['image_path']);
        }

        $del = "DELETE FROM images WHERE id = :id";
        $stmt = $pdo->prepare($del);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

header("Location: index.php");
exit();