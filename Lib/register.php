<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/food2.jpg') center/cover no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .register-container h2 {
            text-align: center;
            color: #333;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-button {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #218838;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById("longitude").value = position.coords.longitude;
            document.getElementById("latitude").value = position.coords.latitude;
        }
    </script>
</head>
<body onload="getLocation()">

<div class="register-container">
    <h2>Register</h2>
    <form class="register-form" action="fphp/process_registration.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="hidden" id="longitude" name="longitude">
        <input type="hidden" id="latitude" name="latitude">
        <button type="submit" class="register-button">Register</button>
    </form>
    <div class="login-link">
        Already signed up? <a href="login.php">Login Now</a>
    </div>
</div>

<?php
// Check if registration was successful
if (isset($_SESSION['register_success'])) {
    echo "<script>
        alert('Registration successful!');
        window.location.href = 'login.php';
    </script>";
    unset($_SESSION['register_success']);
}
?>

</body>
</html>