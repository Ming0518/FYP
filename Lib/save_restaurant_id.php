<?php
session_start();

// Get the JSON input from the request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['restaurantId'])) {
    $_SESSION['matching_restaurant'] = $data['restaurantId'];

    // Send a JSON response back to the client
    echo json_encode(array('success' => true));
} else {
    // Send a JSON response back to the client indicating an error
    echo json_encode(array('success' => false, 'message' => 'No restaurant ID provided'));
}
?>
