<?php
session_start();

if (isset($_POST['submit_reservation'])) {
    // Include your database connection file
    include 'db_connection.php';

    // Retrieve data from the form
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $number_of_people = $_POST['number_of_people'];
    $user_id = $_SESSION['user_id']; // Assuming you have stored the user ID in the session variable
    $restaurant_id = $_SESSION['matching_restaurant']; // Get the restaurant ID from the session

    // Example SQL query to insert data into the table
    $sql = "INSERT INTO reservations (date, time, people, user_id, restaurants_id) VALUES (?, ?, ?, ?, ?)";

    try {
        // Prepare the SQL statement
        $statement = $pdo->prepare($sql);
        // Bind parameters and execute the statement
        $statement->execute([$reservation_date, $reservation_time, $number_of_people, $user_id, $restaurant_id]);

        // Check if the insertion was successful
        if ($statement) {
            // Prompt a message and then redirect to index page
            echo '<script>alert("Reservation created successfully!");</script>';
            echo '<script>window.location.replace("index.php");</script>';
            exit();
        } else {
            echo "Error creating reservation.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
