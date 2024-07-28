<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$host = 'localhost';
$dbname = 'foodhunter';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/user/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadedFilePath = $uploadDir . basename($_FILES['profilePicture']['name']);

        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadedFilePath)) {
            $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $stmt->execute([basename($_FILES['profilePicture']['name']), $_SESSION['user_id']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error moving uploaded file to destination directory.']);
            exit();
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET address = ?, bio = ?, longitude = ?, latitude = ? WHERE id = ?");
    $stmt->execute([$_POST['address'], $_POST['bio'], $_POST['longitude'], $_POST['latitude'], $_SESSION['user_id']]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'General error: ' . $e->getMessage()]);
}
?>
