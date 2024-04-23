<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Return an error message if user is not logged in
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in']);
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

    // Prepare and execute SQL query to fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Return an error message if user is not found
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'User not found']);
        exit();
    }

    // Return user data as JSON response
    echo json_encode($user);
} catch (PDOException $e) {
    // Handle database connection error
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database connection error']);
}
?>
