<?php
session_start();

// Check for a logged-in user
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

include 'db_connect.php'; // Your database connection script

// Sanitize input
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
$bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_SPECIAL_CHARS);

try {
    $stmt = $pdo->prepare("UPDATE users SET address = ?, bio = ? WHERE id = ?");
    $stmt->execute([$address, $bio, $_SESSION['user_id']]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error']);
}
?>
