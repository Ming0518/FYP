<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../Lib/index.php");
    exit;
}

// Include the database connection file
include_once "db_connection.php";

// Define a variable to hold the success message
$success_message = "";

// Check if the form for adding a restaurant is submitted
if (isset($_POST['add_restaurant'])) {
    // Retrieve form data
    $name = $_POST['restaurant_name'];
    $location = $_POST['restaurant_location'];
    $description = $_POST['restaurant_description'];

    // Perform validation if needed

    // Insert data into the restaurant table
    $stmt = $pdo->prepare("INSERT INTO restaurants (name, location, description) VALUES (?, ?, ?)");
    $stmt->execute([$name, $location, $description]);

    // Set the success message
    $success_message = "Restaurant added successfully.";

    // Redirect the user after adding the restaurant
    header("Location: add.php");
    exit;
}

// Check if the form for adding a meal is submitted
if (isset($_POST['add_meal'])) {
    // Retrieve form data
    $restaurant_id = $_POST['restaurant_id'];
    $price = $_POST['meal_price'];
    $ranking = $_POST['meal_ranking'];
    $meal_name = $_POST['meal_name'];
    $meal_image_name = $_POST['meal_image_name'];

    // Perform validation if needed

    // Upload and save the image
    $image_folder = "images/meals/";
    $image_name = $meal_image_name . ".png"; // Change to .png or .jpg depending on the allowed image types
    $image_path = $image_folder . $image_name;

    if (move_uploaded_file($_FILES['meal_image']['tmp_name'], $image_path)) {
        // Insert data into the meals table
        $stmt = $pdo->prepare("INSERT INTO meals (restaurant_id, name, price, ranking, img) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$restaurant_id, $meal_name, $price, $ranking, $meal_image_name]);

        // Set the success message
        $success_message = "Meal added successfully.";

        // Redirect the user after adding the meal
        header("Location: add.php");
        exit;
    } else {
        // Error handling if image upload fails
        echo "Failed to upload image.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Meals</title>

    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <script type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- script ================================================== -->
    <script src="js/modernizr.js"></script>
    <style>
         body {
            font-family: Arial, sans-serif;
            background: url('images/blog5.jpg') center/cover no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh; /* Use min-height instead of height */
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 30px;
            text-align: center;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form textarea:focus {
            outline: none;
            border-color: #007bff;
        }

    

        .error-message {
            color: #dc3545;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1 class="mt-5">Add Meal</h1>
        <!-- Meal form -->
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant ID:</label>
                <input type="number" id="restaurant_id" name="restaurant_id" required>
            </div>
            <div class="mb-3">
                <label for="meal_price" class="form-label">Price:</label>
                <input type="number" id="meal_price" name="meal_price" required>
            </div>
            <div class="mb-3">
                <label for="meal_ranking" class="form-label">Ranking:</label>
                <select id="meal_ranking" name="meal_ranking" required>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="meal_name" class="form-label">Meal Name:</label>
                <input type="text" id="meal_name" name="meal_name" required>
            </div>
            <div class="mb-3">
                <label for="meal_image_name" class="form-label">Meal Image Name:</label>
                <input type="text" id="meal_image_name" name="meal_image_name" required>
            </div>
            <div class="mb-3">
                <label for="meal_image" class="form-label">Meal Image:</label>
                <input type="file" id="meal_image" name="meal_image" accept="image/png, image/jpeg" required>
            </div>
            <!-- Submit button for adding a meal -->
            <button type="submit" name="add_meal" class="btn btn-primary">Add Meal</button>
        </form>
    </div>

    <!-- Script to display success message -->
    <script>
        // Function to display a success message
        function showSuccessMessage(message) {
            alert(message);
        }

        // Check if a success message is set and display it
        <?php if (!empty($success_message)): ?>
            showSuccessMessage("<?php echo $success_message; ?>");
        <?php endif; ?>
    </script>
        <a href="add.php" class="btn btn-primary" style="position: absolute; top: 20px; left: 20px;">Go Back</a>

</body>

</html>
