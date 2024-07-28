<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Food Hunter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/master-chef.jpg');
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
            background: rgba(255, 255, 255, 0.8);
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

        input, textarea {
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
        session_start();

        if (isset($_SESSION['user_id'])) {
            require_once 'db_connection.php';

            $profilePicPath = '';
            $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $profilePicPath = !empty($row['profile_pic']) ? 'images/user/' . $row['profile_pic'] : 'images/user/default.png';
            } else {
                header('Location: login.php');
                exit;
            }

            $pdo = null;
        } else {
            header('Location: login.php');
            exit;
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

            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" placeholder="Enter your longitude">

            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" placeholder="Enter your latitude">

            <input type="file" id="profilePictureInput" name="profilePicture" accept="image/*" style="display: none;" onchange="previewProfilePicture(event)">

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('fetch_user.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('username').value = data.username;
                    document.getElementById('email').value = data.email;
                    document.getElementById('address').value = data.address;
                    document.getElementById('bio').value = data.bio;
                    document.getElementById('longitude').value = data.longitude;
                    document.getElementById('latitude').value = data.latitude;
                })
                .catch(error => console.error('Error fetching user data:', error));

            document.getElementById('profileForm').addEventListener('submit', function (event) {
                event.preventDefault();

                fetch('fphp/update_profile.php', {
                        method: 'POST',
                        body: new FormData(this)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile updated successfully!');
                            location.reload();
                        } else {
                            alert('Error updating profile: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error updating profile:', error));
            });
        });

        function changeProfilePicture() {
            document.getElementById('profilePictureInput').click();
        }

        function previewProfilePicture(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                document.getElementById('profileImage').src = reader.result;
            };

            reader.readAsDataURL(file);
        }
    </script>

</body>

</html>
