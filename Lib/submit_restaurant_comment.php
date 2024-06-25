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
        $restaurant_id = filter_input(INPUT_POST, 'restaurant_id', FILTER_VALIDATE_INT);
        $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
        $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

        // Retrieve the user ID from the session
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Check if all required fields are not empty
        if ($restaurant_id && $latitude && $longitude && $name && $email && $comment && $user_id) {
            // Prepare an insert statement
            $sql = "INSERT INTO restaurant_comments (restaurant_id, name, email, comment, user_id, latitude, longitude) VALUES (:restaurant_id, :name, :email, :comment, :user_id, :latitude, :longitude)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':restaurant_id', $restaurant_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':latitude', $latitude);
            $stmt->bindParam(':longitude', $longitude);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Set a session variable to indicate success
                $_SESSION['comment_success'] = true;
                // Redirect to a confirmation page or back to the form
                header("Location: comment.php");
                exit;
            } else {
                // Redirect back with error message
                header("Location: comment.php?restaurants_id=$restaurant_id&success=0");
                exit;
            }
        } else {
            // Redirect back with error message
            header("Location: comment.php?restaurants_id=$restaurant_id&success=0&error=missing_fields");
            exit;
        }
    }
} catch (PDOException $e) {
    // Log error and redirect back with error message
    error_log($e->getMessage());
    header("Location: comment.php?restaurants_id=$restaurant_id&success=0&error=database_error");
    exit;
}
?>
