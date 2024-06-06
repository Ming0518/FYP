<?php
include 'db_connection.php';

$user_id = 1; // Assume the logged-in user has ID 1 for simplicity

$sql = "SELECT users.id, users.username FROM friends JOIN users ON friends.friend_id = users.id WHERE friends.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$friends = [];
while ($row = $result->fetch_assoc()) {
    $friends[] = $row;
}

echo json_encode($friends);
?>
