<?php

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'foodhunter';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error message
    error_log("Error: Could not connect to the database. " . $e->getMessage());
    // Display an error message to the user
    die("Error: Could not connect to the database.");
}
?>
