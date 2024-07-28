<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodhunter";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch restaurants with optional filters
$locationFilter = isset($_GET['location']) ? $_GET['location'] : '';
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$sql = "SELECT * FROM restaurants WHERE 1=1";

if ($locationFilter) {
    $sql .= " AND location = '" . $conn->real_escape_string($locationFilter) . "'";
}

if ($categoryFilter) {
    $sql .= " AND category = '" . $conn->real_escape_string($categoryFilter) . "'";
}

$result = $conn->query($sql);

$restaurants = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }
}

echo json_encode(['restaurants' => $restaurants]);

$conn->close();
?>
