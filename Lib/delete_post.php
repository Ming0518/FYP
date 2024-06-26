<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodhunter";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $sql = "DELETE FROM blog WHERE id = $post_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ublog.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
