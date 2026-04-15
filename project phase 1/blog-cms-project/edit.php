<?php
include 'db.php';
include 'includes/header.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute([':id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $body = trim($_POST['body']);

    $stmt = $conn->prepare(
        "UPDATE posts SET title = :title, category = :category, body = :body WHERE id = :id"
    );

    $stmt->execute([
        ':title' => $title,
        ':category' => $category,
        ':body' => $body,
        ':id' => $id
    ]);

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