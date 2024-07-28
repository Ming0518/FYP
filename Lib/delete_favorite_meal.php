<?php
// Check if meal ID is provided and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodhunter";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape the meal ID to prevent SQL injection
    $meal_id = $conn->real_escape_string($_GET['id']);

    // SQL query to delete the meal
    $sql = "DELETE FROM favorite_meals WHERE id = $meal_id";

    if ($conn->query($sql) === TRUE) {
        // Delete successful, redirect back to the page where the meal list is displayed
        header("Location: ublog.php"); // Replace index.php with the appropriate page
        exit();
    } else {
        // Error occurred while deleting the meal
        echo "Error deleting record: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Redirect to an error page or handle the case where ID is missing or invalid
    header("Location: error.php");
    exit();
}
?>
