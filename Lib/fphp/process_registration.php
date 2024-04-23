<?php
session_start();


// Database connection parameters
$host = 'localhost';
$dbname = 'foodhunter';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate and sanitize input
        // You can implement more thorough validation as per your requirements
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if user already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            // User already exists, handle accordingly (e.g., display error message)
            echo "User with this username or email already exists.";
        } else {
            // Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);

            // Redirect user to login page after successful registration
            header("Location: ../login.php");
            exit();
        }
    }
} catch (PDOException $e) {
    // Handle database connection error
    die("Error: " . $e->getMessage());
}
?>
