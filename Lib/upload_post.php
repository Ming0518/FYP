<?php
session_start();

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

// Retrieve user_id from session
if (!isset($_SESSION['user_id'])) {
    die("User ID not set in session.");
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$picture = $_FILES['picture']['name'];
$target_dir = "images/blog/";
$target_file = $target_dir . basename($picture);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["picture"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowed_file_types = array("jpg", "png", "jpeg", "gif");
if (!in_array($imageFileType, $allowed_file_types)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picture"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Insert data into database if upload was successful
if ($uploadOk == 1) {
    $sql = "INSERT INTO blog (user_id, title, description, picture) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $title, $description, $picture);

    if ($stmt->execute()) {
        // Display success message and refresh page
        echo "<script type='text/javascript'>
                alert('New record created successfully');
                window.location.href = 'ublog.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }
}

$conn->close();
?>
