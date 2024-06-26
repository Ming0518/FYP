<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Check if comment ID is provided
if (!isset($_GET['id'])) {
    header('Location: history.php');
    exit();
}

$comment_id = $_GET['id'];

// Database connection details
$host = 'localhost';
$dbname = 'foodhunter';
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch comment details
    $stmt = $pdo->prepare("SELECT comment FROM restaurant_comments WHERE id = ? AND email = ?");
    $stmt->execute([$comment_id, $_SESSION['email']]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$comment) {
        header('Location: history.php');
        exit();
    }

    // Handle form submission for updating the comment
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updated_comment = $_POST['comment'];
        $stmt = $pdo->prepare("UPDATE restaurant_comments SET comment = ? WHERE id = ? AND email = ?");
        $stmt->execute([$updated_comment, $comment_id, $_SESSION['email']]);
        header('Location: history.php');
        exit();
    }

} catch (PDOException $e) {
    echo "Database connection error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Comment - Food Hunter</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Comment</h2>
        <form method="post">
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" rows="4" class="form-control" required><?php echo htmlspecialchars($comment['comment']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="history.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
