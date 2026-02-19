<?php
// UPDATE - Edit post

include 'db.php';
include 'includes/header.php';

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM posts WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $body = trim($_POST['body']);

    $stmt = mysqli_prepare($conn,
        "UPDATE posts SET title=?, category=?, body=? WHERE id=?"
    );

    mysqli_stmt_bind_param($stmt, "sssi", $title, $category, $body, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='alert alert-success'>Post updated successfully!</div>";
}
?>

<h2>Edit Post</h2>

<form method="POST">

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control"
               value="<?php echo htmlspecialchars($post['title']); ?>">
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" class="form-control"
               value="<?php echo htmlspecialchars($post['category']); ?>">
    </div>

    <div class="mb-3">
        <label>Body</label>
        <textarea name="body" class="form-control" rows="4"><?php echo htmlspecialchars($post['body']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>

<?php include 'includes/footer.php'; ?>
