<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel - Food Hunter</title>

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

    <script>
    function logout() {
    // Perform logout actions, such as clearing session data

    // Clear login state
    localStorage.removeItem('isLoggedIn');
    
    // Redirect or update UI as needed
    window.location.reload(); // Example: reload the current page
}

    </script>
    <style>
        /* Your CSS styles for the admin panel */
        body {
            font-family: Arial, sans-serif;
            background-image: url('../Lib/images/dinning-table-room.jp'); /* Add your background image path here */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-header {
            background: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background to improve text visibility */
            padding: 10px 20px; /* Adjust padding as needed */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px; /* Add margin bottom to separate from services */
            display: inline-block; /* Make it an inline-block to center */
        }
        body {
    font-family: Arial, sans-serif;
    background-color: #9EB7E9; /* Change this color to your desired background color */
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}


        /* Your existing styles */

        .service-post {
            background: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background to improve text visibility */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin: 10px; /* Add margin to separate the boxes */
        }

        .navigation-menu {
            text-align: center;
            margin-bottom: 20px;
        }

        .navigation-menu ul {
            list-style-type: none;
            padding: 0;
        }

        .navigation-menu ul li {
            display: inline;
            margin-right: 20px;
        }

        .navigation-menu ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .logout-btn {
            margin-left: auto;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2" tabindex="0">

    <!-- Services Section Starts -->
    <section id="services" class="my-5">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-center my-5" > Admin Function</h1>
            <a href="..\Lib\index.php" class="btn btn-primary first-button my-5 logout-btn" onclick="logout()">Log Out</a>
        </div>
        <div class="container">
            <div class="row py-5">
                <div class="col-md-3">
                    <div class="service-post py-5 px-5">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
                            <img src="images/add.png" alt="" width ="100" height = "100">
                        </div>
                        <h3>Adding Restaurants</h3>
                        <p>-- </p>
                        <a href="add.php" class="icon-link">Select </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-post py-5 px-5">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                            <img src="images/owner.png" alt=""width ="100" height = "100">
                        </div>
                        <h3>Manage Restaurants</h3>
                        <p>-- </p>
                        <a href="edit.php" class="icon-link">Select </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-post py-5 px-5">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                            <img src="images/feedback.png" alt=""width ="100" height = "100">
                        </div>
                        <h3>Manage Comments</h3>
                        <p>--</p>
                        <a href="comment.php" class="icon-link">Select </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-post py-5 px-5">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                            <img src="images/management.png" alt=""width ="100" height = "100">
                        </div>
                        <h3>Manage User Info</h3>
                        <p>-- </p>
                        <a href="user.php" class="icon-link">Select </a>
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>

</html>
