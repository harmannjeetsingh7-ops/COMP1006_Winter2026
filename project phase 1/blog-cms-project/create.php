<?php
// CREATE - Add new post

include 'db.php';
include 'includes/header.php';

$title = $category = $body = "";
$date = date('Y-m-d'); // Default to today's date
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $body = trim($_POST['body']);
    $date = trim($_POST['date']);

    // Server-side validation
    if (empty($title)) {
        $errors[] = "Title is required.";
    }

    if (empty($category)) {
        $errors[] = "Category is required.";
    }

    if (empty($body)) {
        $errors[] = "Body is required.";
    }
    if (empty($date)) {
        $errors[] = "Date is required.";
    }

    // Google reCAPTCHA verification
    $secretKey = "6LfSkHAsAAAAAIS5JuHQNTJTuaq6dnd73OiVc5JQ";
    $responseKey = $_POST['g-recaptcha-response'];

    if (!empty($responseKey)) {
        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey"
        );

        $captchaSuccess = json_decode($verify);

        if (!$captchaSuccess->success) {
            $errors[] = "reCAPTCHA verification failed.";
        }
    } else {
        $errors[] = "Please complete the reCAPTCHA.";
    }

    // If no errors → Insert into DB
    if (empty($errors)) {

        $stmt = mysqli_prepare($conn,
            "INSERT INTO posts (title, category, body, created_at) VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param($stmt, "ssss", $title, $category, $body, $date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "<div class='alert alert-success'>Post added successfully!</div>";

        $title = $category = $body = $date = "";
    }
}
?>

<h2>Add New Post</h2>

<?php
if (!empty($errors)) {
    echo "<div class='alert alert-danger'>";
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
}
?>

<form method="POST" id="postForm">

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control"
               value="<?php echo htmlspecialchars($title); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="text" name="category" class="form-control"
               value="<?php echo htmlspecialchars($category); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Body</label>
        <textarea name="body" class="form-control" rows="4"><?php echo htmlspecialchars($body); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control"
               value="<?php echo htmlspecialchars($date); ?>">
    </div>

    <div class="g-recaptcha" data-sitekey="6LfSkHAsAAAAAGR2sGeksDrmxu3u2jvor9jqnE08"></div>

    <br>

    <button type="submit" class="btn btn-primary">Save Post</button>
</form>

<?php include 'includes/footer.php'; ?>
