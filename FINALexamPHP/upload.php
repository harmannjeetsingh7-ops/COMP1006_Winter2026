<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];

    if (empty($title) || $_FILES['image']['error'] !== 0) {
        $error = "Fill all fields";
    } else {

        $path = handleUpload($_FILES['image']);

        if ($path) {

            $sql = "INSERT INTO images (admin_id, title, image_path) 
                    VALUES (:id, :title, :path)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $_SESSION['user_id']);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':path', $path);

            $stmt->execute();

            header("Location: index.php");
            exit();
        } else {
            $error = "Upload failed";
        }
    }
}
?>

<h2>Upload</h2>

<?php if (!empty($error)) echo $error; ?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title">
    <input type="file" name="image">
    <button type="submit">Upload</button>
</form>