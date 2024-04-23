<?php
session_start();

// Database connection parameters
$host = 'localhost';
$dbname = 'foodhunter';
$username = '';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
