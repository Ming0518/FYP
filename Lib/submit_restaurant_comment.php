<?php
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
        $restaurant_id = filter_input(INPUT_POST, 'restaurant_id', FILTER_SANITIZE_NUMBER_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

        // Prepare an insert statement
        $sql = "INSERT INTO restaurant_comments (restaurant_id, name, email, comment) VALUES (:restaurant_id, :name, :email, :comment)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':restaurant_id', $restaurant_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);

        // Execute the prepared statement
        $stmt->execute();

        // Redirect to the same page with a success message
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
        exit;
    }
} catch (PDOException $e) {
    // Redirect back with error message
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=0");
    exit;
}
?>
