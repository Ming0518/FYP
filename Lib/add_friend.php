<?php
// add_friend.php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$db = 'foodhunter';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(['success' => false]));
}

// Get the friend ID from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$friend_id = isset($data['id']) ? (int)$data['id'] : 0;

if ($friend_id === 0) {
    echo json_encode(['success' => false]);
    exit;
}

// Add friend to the friend list (assuming a friends table)
$user_id = 1; // Replace with the current user's ID
$sql = "INSERT INTO friends (user_id, friend_id) VALUES ($user_id, $friend_id)";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
