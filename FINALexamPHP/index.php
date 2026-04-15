<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

requireLogin();

$sql = "SELECT * FROM images ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();
?>

<h2>Gallery</h2>

<p>Welcome, <?php echo e($_SESSION['user_name']); ?></p>

<a href="upload.php">Upload New Image</a>
<br><br>

<?php foreach ($images as $img): ?>

    <div>
        <img src="<?php echo $img['image_path']; ?>" width="200">
        <p><?php echo e($img['title']); ?></p>

        <a href="delete.php?id=<?php echo $img['id']; ?>">Delete</a>
    </div>

    <br>

<?php endforeach; ?>