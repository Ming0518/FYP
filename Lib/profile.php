<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

<script src="profile.js" defer></script>

</head>

<body>

    <div class="container">
        <h2>User Profile - Food Hunter</h2>
        <form id="profileForm" method="post" action="fphp/update_profile.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required disabled>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required disabled>

            <label for="address">Address:</label>
            <textarea id="address" name="address" placeholder="Enter your address"></textarea>

            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" placeholder="Write a brief bio about yourself"></textarea>

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
                        } else {
                            alert('Error updating profile: ' + data.message); // Show error alert
                        }
                    })
                    .catch(error => console.error('Error updating profile:', error));
            });
        });
    </script>

</body>

</html>
