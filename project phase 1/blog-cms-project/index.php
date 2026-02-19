<?php
// READ - Display all posts

include 'db.php';
include 'includes/header.php';

$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<h2 class="mb-4">All Blog Posts</h2>

<?php if (mysqli_num_rows($result) > 0): ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>

        <div class="card mb-3">
            <div class="card-body">
                <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($row['body'])); ?></p>

                <a href="edit.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-warning btn-sm">Edit</a>

                <a href="delete.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure?');">Delete</a>
            </div>
        </div>

    <?php endwhile; ?>

<?php else: ?>
    <div class="alert alert-info">No posts found.</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
