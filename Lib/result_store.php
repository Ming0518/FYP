<?php
session_start();

// Check if location and category are set in the form submission
if (isset($_GET['location']) && isset($_GET['category'])) {
    $location = $_GET['location'];
    $category = $_GET['category'];

    // Perform database query to fetch matching restaurants
    // Assuming you have a PDO connection established
    
    $host = 'localhost';
    $dbname = 'foodhunter';
    $username = 'root'; // Your database username
    $password = ''; // Your database password
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute SQL query to fetch matching restaurants
        $stmt = $pdo->prepare("SELECT id FROM restaurants WHERE location = ? AND category = ?");
        $stmt->execute([$location, $category]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a matching restaurant was found
        if ($result) {
            // Save the restaurant ID in the session
            $_SESSION['matching_restaurant'] = $result['id'];

            // Redirect to a page to display the matching restaurant
            header("Location: example.php");
            exit();
        } else {
            // No matching restaurants found, handle this case (e.g., show a message)
            echo "No restaurants found matching the selected criteria.";
        }
    } catch (PDOException $e) {
        // Handle database connection error
        echo "Database connection error: " . $e->getMessage();
    }
} else {
    // Location or category not set in the form submission, handle this case
    echo "Please select both location and category.";
}
?>
