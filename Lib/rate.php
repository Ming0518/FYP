<?php
session_start();

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'foodhunter';

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Error: Could not connect to the database. " . $e->getMessage());
    die("Error: Could not connect to the database.");
}

// Fetch reservation data from the database for the logged-in user
try {
    $user_id = $_SESSION['user_id']; // Assuming you have stored the user ID in the session variable
    $stmt = $pdo->prepare("SELECT reservations.*, restaurants.name AS restaurant_name 
                           FROM reservations 
                           JOIN restaurants ON reservations.restaurants_id = restaurants.id 
                           WHERE reservations.user_id = ?");
    $stmt->execute([$user_id]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error: Failed to fetch reservation data. " . $e->getMessage());
    die("Error: Failed to fetch reservation data.");
}

// Example variable to determine if reservation time is over (replace with your logic)
$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate & Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            max-width: 600px;
            width: 100%;
            margin-top: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-container a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-container a:hover {
            background-color: #45a049;
        }

        .back-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div class="back-button">
    <button onclick="window.location.href='history.php'" class="custom-button">View Comment History</button>
</div>
    <div class="container">
        <h2>Rate & Review</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Number of People</th>
                    <th>Restaurant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                    <td><?php echo htmlspecialchars($reservation['restaurant_name']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['date']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['time']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['people']); ?></td>
                        <td>
                            <?php if ($reservation['date'] <= $currentDate) : ?>
                                <a href="comment.php?restaurants_id=<?php echo $reservation['restaurants_id']; ?>">Leave a Comment</a>                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Back button placed below the container -->
    <a href="index.php" class="back-button">Back to Home</a>
</body>

</html>
