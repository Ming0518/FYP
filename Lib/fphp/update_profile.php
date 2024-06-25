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

    // Handle file upload if a file is selected
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
        // Specify upload directory and move the uploaded file
        $uploadDir = 'images/user/';
        $uploadedFilePath = $uploadDir . basename($_FILES['profilePicture']['name']);

        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadedFilePath)) {
            // File upload successful, update profile picture path in the database
            $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $stmt->execute([basename($_FILES['profilePicture']['name']), $_SESSION['user_id']]);
        } else {
            // Handle file upload error
            echo json_encode(['success' => false, 'message' => 'Error moving uploaded file to destination directory.']);
            exit();
        }
    }

    // Prepare and execute SQL query to update user's address and bio
    $stmt = $pdo->prepare("UPDATE users SET address = ?, bio = ? WHERE id = ?");
    $stmt->execute([$_POST['address'], $_POST['bio'], $_SESSION['user_id']]);

    // Return success response
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Handle database connection error
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $e->getMessage()]);
}
?>
