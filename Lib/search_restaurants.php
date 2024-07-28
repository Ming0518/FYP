<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "foodhunter";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search query from GET parameter
if (isset($_GET['query'])) {
    $query = strtolower($conn->real_escape_string($_GET['query']));
    $sql = "SELECT id, name FROM restaurants WHERE LOWER(name) LIKE '%$query%'";
    $result = $conn->query($sql);

    $restaurants = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $restaurants[] = array(
                'id' => $row['id'],
                'name' => $row['name']
            );
        }
    }

    // Prepare JSON response
    $response = array('restaurants' => $restaurants);
    echo json_encode($response);
} else {
    // If no query parameter provided
    echo json_encode(array('restaurants' => array()));
}

$conn->close();
?>
