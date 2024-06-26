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

    // Delete the comment
    $stmt = $pdo->prepare("DELETE FROM restaurant_comments WHERE id = ? AND email = ?");
    $stmt->execute([$comment_id, $_SESSION['email']]);

    header('Location: history.php');
    exit();

} catch (PDOException $e) {
    echo "Database connection error: " . $e->getMessage();
    exit();
}
?>
