<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Food Hunter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/master-chef.jpg'); /* Replace with the actual image path */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background to improve text visibility */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        img.profile-pic {
            border-radius: 50%;
            margin-bottom: 20px;
            cursor: pointer;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>User Profile - Food Hunter</h2>
        <?php
        session_start(); // Start the session if it's not already started

        // Check if user ID is set in the session
        if (isset($_SESSION['user_id'])) {
            // Include the database connection file
            require_once 'db_connection.php';

            // Fetch user data including profile picture from the database
            $profilePicPath = ''; // Default profile picture path

            // Example query to fetch profile picture name and check if it's empty using user ID from session
            $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Check if profile picture field is not empty
                if (!empty($row['profile_pic'])) {
                    // Profile picture is not empty, set the profile picture path
                    $profilePicName = $row['profile_pic'];
                    $profilePicPath = 'images/user/' . $profilePicName; // Update with your actual path
                } else {
                    // Profile picture is empty, set default path
                    $profilePicPath = 'images/user/ori.png'; // Update with your default picture path
                }
            } else {
                // User not found in the database, handle this case as needed
                // For example, redirect to login page or display an error message
                header('Location: login.php'); // Redirect to login page or another appropriate page
                exit; // Terminate script execution
            }

            // Close the database connection
            $pdo = null;
        } else {
            // Redirect or handle the case where user ID is not set in the session
            header('Location: login.php'); // Redirect to login page or another appropriate page
            exit; // Terminate script execution
        }
        ?>

        <img src="<?php echo $profilePicPath; ?>" alt="Profile Picture" class="profile-pic" width="150" height="150" id="profileImage" onclick="changeProfilePicture()">
        <form id="profileForm" method="post" action="fphp/update_profile.php" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required disabled>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required disabled>

            <label for="address">Address:</label>
            <textarea id="address" name="address" placeholder="Enter your address"></textarea>

            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" placeholder="Write a brief bio about yourself"></textarea>

            <input type="file" id="profilePictureInput" name="profilePicture" accept="image/*" style="display: none;" onchange="previewProfilePicture(event)">

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch user data from the server
            fetch('fetch_user.php')
                .then(response => response.json())
                .then(data => {
                    // Populate form fields with user data
                    document.getElementById('username').value = data.username;
                    document.getElementById('email').value = data.email;
                    document.getElementById('address').value = data.address; // Populate address
                    document.getElementById('bio').value = data.bio; // Populate bio
                    // Disable username and email fields
                    document.getElementById('username').disabled = true;
                    document.getElementById('email').disabled = true;
                })
                .catch(error => console.error('Error fetching user data:', error));

            // Listen for form submission
            document.getElementById('profileForm').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the form from submitting normally

                // Submit the form data using fetch
                fetch('fphp/update_profile.php', {
                        method: 'POST',
                        body: new FormData(this)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile updated successfully!'); // Show success alert
                            location.reload();

                        } else {
                            alert('Error updating profile: ' + data.message); // Show error alert
                        }
                    })
                    .catch(error => console.error('Error updating profile:', error));
            });
        });

        function changeProfilePicture() {
            document.getElementById('profilePictureInput').click();
        }

        function previewProfilePicture(event) {
            const file = event.target.files[0]; // Get the selected file
            const reader = new FileReader(); // Create a file reader object

            // Set up the file reader onload function
            reader.onload = function () {
                document.getElementById('profileImage').src = reader.result; // Update the profile picture preview
            };

            // Read the selected file as a data URL (base64 encoded image)
            reader.readAsDataURL(file);
        }
    </script>

</body>

</html>
