<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hunger Hunter - Free Restaurant HTML CSS Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" media="screen" href="superfish/css/superfish.css">	
    <script src="superfish/js/hoverIntent.js"></script>
    <script src="superfish/js/superfish.js"></script>
    <style>
        .comments-history {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .comment-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
        }
        .comment-item p {
            margin-bottom: 5px;
        }
        .comment-item .meta {
            font-size: 12px;
            color: #666;
        }

        .post-content .btn {
            display: inline-block; /* Ensure buttons are always visible */
        }
    </style>
    <script>
        function confirmDelete(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                window.location.href = "delete_post.php?id=" + postId;
            }
        }
        function confirmfavDelete(mealId) {
        if (confirm("Are you sure you want to delete this meal?")) {
            window.location.href = "delete_favorite_meal.php?id=" + mealId;
        }
    }
    </script>
</head>
<body>
 <div class="main-wrapper">
 <header id="header-wrap">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg col-md-12">
                    <div class="navbar-brand">
                        <a href="index.php">
                            <img src="images/logo.png">
                        </a>
                    </div>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#slide-navbar-collapse" aria-controls="slide-navbar-collapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="icon icon-navicon"></i></span>
                    </button>
                    <div class="navbar-collapse collapse" id="slide-navbar-collapse">
                        <ul class="navbar-nav light list-inline strong sf-menu">
                            <li class="nav-item active">
                                <a href="index.php" class="nav-link" data-effect="Home">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="ublog.php" class="nav-link" data-effect="Reservation">RESTAURANTS</a>
                            </li>
                            <li class="nav-item">
                                <a href="friend.php" class="nav-link" data-effect="Menu">FRIENDS</a>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="rate.php" data-effect="Blog" class="nav-link" class="dropdown-toggle">RATE & REVIEW</a>
                            </li>
                            <li class="nav-item">
                                <a href="profile.php" target="_blank" class="nav-link" data-effect="Menu"> <b>PROFILE</b>  </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
<div class="page-banner">
    <div class="text-content bright heading text-center light">
        <h1 class="section-title"><strong>Check</strong>personal blogs</h1>
            <div class="divider mb-4">
                <div class="icon-wrap">
                    <i class="icon icon-spoon"></i>
                </div>
            </div>
        <div class="slogan mb-5">see the article from famous foodies</div>
    </div>
</div>
<section class="blog-page">
<div class="container mt-sm-5 mt-6">    
    <div class="row">
    <div id="main-content" class="col-md-8">
        <div class="row">
        <?php
        

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodhunter";

// Check if user is logged in and session variable exists
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id']; // Fetch user ID from session

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display blog posts
$sql_blog = "SELECT id, picture, title, description FROM blog WHERE user_id = $user_id";
$result_blog = $conn->query($sql_blog);

if ($result_blog->num_rows > 0) {
    while($row = $result_blog->fetch_assoc()) {
        echo '<div class="post-item mb-5">';
        echo '<figure>';
        echo '<img src="images/blog/' . $row["picture"] . '" alt="' . $row["title"] . '" class="postImg">';
        echo '</figure>';
        echo '<div class="post-content">';
        echo '<h2 class="post-title">' . $row["title"] . '</h2>';
        echo '<p>' . $row["description"] . '</p>';
        echo '<a href="edit_post.php?id=' . $row["id"] . '" class="btn btn-success">Edit</a>';
        echo '<button onclick="confirmDelete(' . $row["id"] . ')" class="btn btn-danger">Delete</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "You dont upload any blog yet.";
}

// Fetch and display comments
$sql_comments = "SELECT rc.comment, rc.created_at, r.name as restaurant_name 
                 FROM restaurant_comments rc 
                 JOIN restaurants r ON rc.restaurant_id = r.id 
                 WHERE rc.user_id = $user_id 
                 ORDER BY rc.created_at DESC";
$result_comments = $conn->query($sql_comments);

if ($result_comments->num_rows > 0) {
    echo '<div class="comments-history">';
    echo '<h3>Comments History</h3>';
    while($row = $result_comments->fetch_assoc()) {
        echo '<div class="comment-item">';
        echo '<p>' . $row["comment"] . '</p>';
        echo '<div class="meta">Restaurant: ' . $row["restaurant_name"] . ' | Posted on: ' . $row["created_at"] . '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="comments-history">';
    echo '<h3>Comments History</h3>';
    echo '<p>No comments found.</p>';
    echo '</div>';
}

// Close connection
$conn->close();
?>
        </div>
    </div>
    <div class="right-sidebar col-md-3">
    <div class="row">
        <div class="recent-post-box sidebar-box">
            <h3>Favorite Meals</h3>
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "foodhunter";
            $user_id = $_SESSION['user_id'];

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch favorite meals
            $sql = "SELECT id, name, price, image FROM favorite_meals WHERE user_id = $user_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="content d-flex mb-3">';
                    echo '<div class="post-image">';
                    echo '<img src="images/' . $row["image"] . '" class="rpImg">';
                    echo '</div>';
                    echo '<div class="text-block color-secondary">';
                    echo '<a href="#">' . $row["name"] . '</a>';
                    echo '<span class="date">RM ' . $row["price"] . '</span>';
                    echo '<div class="mt-2">';
                    echo '<a href="edit_favorite_meal.php?id=' . $row["id"] . '" class="btn btn-sm btn-primary mr-2">Edit</a>';
                    echo '<button onclick="confirmfavDelete(' . $row["id"] . ')" class="btn btn-sm btn-danger">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No favorite meals found.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</div>


        <div class="post-tags-box sidebar-box">
            <h3>tags</h3>
            <div class="sidebar-tags color-secondary">
                <a href="#">Recipes,</a>
                <a href="#">Desserts,</a>
                <a href="#">Menu,</a>
                <a href="#">Cooking,</a>
                <a href="#">Dinning,</a>
                <a href="#">Food,</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>
<section class="upload-section" style="background-color: #f2f2f2; padding: 30px; border-radius: 10px;">
    <div class="container mt-sm-5 mt-6">
        <h2 class="section-title" style="color: #333; margin-bottom: 20px;">Upload New Blog Post</h2>
        <form action="upload_post.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" style="color: #555;">Title:</label>
                <input type="text" class="form-control" id="title" name="title" style="border: 1px solid #ccc;" required>
            </div>
            <div class="form-group">
                <label for="description" style="color: #555;">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" style="border: 1px solid #ccc;" required></textarea>
            </div>
            <div class="form-group">
                <label for="picture" style="color: #555;">Upload Picture:</label>
                <input type="file" class="form-control-file" id="picture" name="picture" required>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Submit</button>
        </form>
    </div>
</section>
<section class="upload-section">
    <div class="container mt-sm-5 mt-6">
        <h2 class="section-title">Upload Favorite Meal</h2>
        <form action="upload_favorite_meal.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Meal Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price (RM):</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>

    <div class="footer-bottom">
        <div class="container">
            <div class="content">
                <div class="copyright">
                    <p>FOOD HUNTER<a href="https://templatesjungle.com/" target="_blank">.</a></p>
                </div>
                <div class="payment-card">
                    <img src="images/visa.png" class="cardImg">
                    <img src="images/american-express.png" class="cardImg">
                    <img src="images/master-card.png" class="cardImg">
                </div>
            </div>
        </div>
    </div>
 </div>
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
