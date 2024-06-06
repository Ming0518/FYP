<?php
session_start(); // Start the session

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'foodhunter';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input
        $restaurant_id = 1; // This should be dynamically set based on your application logic
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

        // Retrieve the user ID from the session
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Check if all required fields are not empty
        if ($restaurant_id && $name && $email && $comment && $user_id) {
            // Prepare an insert statement
            $sql = "INSERT INTO restaurant_comments (restaurant_id, name, email, comment, user_id) VALUES (:restaurant_id, :name, :email, :comment, :user_id)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':restaurant_id', $restaurant_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':user_id', $user_id);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Set a session variable to indicate success
                $_SESSION['comment_success'] = true;
                // Redirect to the same page
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                // Redirect back with error message
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=0");
                exit;
            }
        } else {
            // Redirect back with error message
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=0&error=missing_fields");
            exit;
        }
    }
} catch (PDOException $e) {
    // Log error and redirect back with error message
    error_log($e->getMessage());
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=0&error=database_error");
    exit;
}
?>
