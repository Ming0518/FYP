<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Database connection parameters
$host = 'localhost';
$dbname = 'foodhunter';
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute SQL query to update user's address and bio
    $stmt = $pdo->prepare("UPDATE users SET address = ?, bio = ? WHERE id = ?");
    $stmt->execute([$_POST['address'], $_POST['bio'], $_SESSION['user_id']]);

    // Return success response
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Handle database connection error
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
}
?>
