<?php
// search_friends.php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$db = 'foodhunter';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die(json_encode(['error' => 'Database connection failed']));
}

// Get the search query
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

if (empty($query)) {
    echo json_encode([]);
    exit;
}

// Search the users table
$sql = "SELECT id, username, latitude, longitude FROM users WHERE username LIKE '%$query%'";
$result = $conn->query($sql);

if ($result === false) {
    error_log("Error in SQL query: " . $conn->error);
    die(json_encode(['error' => 'Error fetching search results']));
}

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Calculate distance for each user
foreach ($users as &$user) {
    $distance = calculateDistance($user['latitude'], $user['longitude']);
    $user['distance'] = $distance;
}

// Encode the result with distance in JSON
echo json_encode(['users' => $users]);

$conn->close();

// Function to calculate distance between two points (you need to implement this)
function calculateDistance($lat2, $lon2)
{
    // Replace these values with user's current latitude and longitude
    $lat1 = 6.128651;
    $lon1 = 100.364565;

    // Calculate distance using Haversine formula or any other suitable method
    // Here's an example Haversine formula implementation
    $earthRadius = 6371; // Radius of the earth in kilometers

    $latDiff = deg2rad($lat2 - $lat1);
    $lonDiff = deg2rad($lon2 - $lon1);

    $a = sin($latDiff / 2) * sin($latDiff / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($lonDiff / 2) * sin($lonDiff / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;

    return $distance; // Distance in kilometers
}
?>
