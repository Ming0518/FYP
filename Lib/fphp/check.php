<?php
session_start();

// Database connection parameters
$host = 'localhost';
$dbname = 'foodhunter';
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve form data
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    // Prepare and execute SQL query to check if username and password match
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$entered_username]);
    $user = $stmt->fetch();

    if ($user && password_verify($entered_password, $user['password'])) {
        // Login successful, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['latitude'] = $user['latitude'];
        $_SESSION['longitude'] = $user['longitude'];
        $_SESSION['email'] = $user['email'];

        // Check if the username is "admin"
        if ($entered_username === 'admin') {
            // If it is, return success with the username
            echo json_encode(['success' => true, 'username' => $user['username']]);
        } else {
            // Otherwise, return success without the username
            echo json_encode(['success' => true]);
        }
    } else {
        // Login failed, return error response
        echo json_encode(['success' => false, 'message' => 'Wrong username or password.']);
    }
    
} catch (PDOException $e) {
    // Handle database connection error
    echo json_encode(['success' => false, 'message' => 'Database connection error.']);
}

?>
