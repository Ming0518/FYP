<?php
session_start(); // Start the session

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        die("User not logged in.");
    }

    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_FILES["image"]["name"];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert favorite meal into the database
        $sql = "INSERT INTO favorite_meals (user_id, name, price, image) VALUES ('$user_id', '$name', '$price', '$image')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
                alert('New record created successfully');
                window.location.href = 'ublog.php';
              </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close connection
$conn->close();
?>
