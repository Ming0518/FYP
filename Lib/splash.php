<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="04f07f83-b8f5-4869-96dc-f222dcbbdc83";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <title>Hunger Hunter - Free Restaurant HTML CSS Template</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--link to the CSS files for this menu type-->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" media="screen" href="superfish/css/superfish.css">   

    <!--link to the JavaScript files (hoverIntent is optional)-->
    <script src="superfish/js/hoverIntent.js"></script>
    <script src="superfish/js/superfish.js"></script>
    <style>
        /* Custom styles for the Comments History section */
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

        /* Custom styles for the user profile section */
        .profile-sidebar {
            margin-bottom: 30px;
            text-align: center;
        }
        .profile-sidebar img {
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .profile-sidebar h3 {
            margin-bottom: 5px;
        }
        .profile-sidebar p {
            margin-bottom: 10px;
        }
    </style>
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
                                <a href="ublog.php" class="nav-link"
                                    data-effect="Reservation">RESTAURANTS</a>
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
                    </div><!--navbar-collapse-->
                </nav>
            </div><!--.row-->
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
    </div><!--site-banner-->

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
                        $user_id = $_GET['id'];

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch and display blog posts
                        $sql_blog = "SELECT picture, title, description FROM blog WHERE user_id = $user_id";
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
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "No blog posts found for this user.";
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
                </div><!--main-content-->

                <div class="right-sidebar col-md-3">
                    <div class="row">

                        <div class="profile-sidebar sidebar-box">
                            <?php
                            // Fetch user profile details
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql_user = "SELECT profile_pic, username, address, bio FROM users WHERE id = $user_id";
                            $result_user = $conn->query($sql_user);

                            if ($result_user->num_rows > 0) {
                                $user = $result_user->fetch_assoc();
                                $profilePicPath = !empty($user['profile_pic']) ? 'images/user/' . $user['profile_pic'] : 'images/user/default.png';

                                echo '<img src="' . $profilePicPath . '" alt="Profile Picture" width="100" height="100">';
                                echo '<h3>' . $user['username'] . '</h3>';
                                echo '<p>' . $user['address'] . '</p>';
                                echo '<p>' . $user['bio'] . '</p>';
                            } else {
                                echo '<p>User profile not found.</p>';
                            }

                            $conn->close();
                            ?>
                        </div><!--profile-sidebar-->

                        <div class="right-sidebar col-md-3">
    <div class="row">
        <div class="post-tags-box sidebar-box">
            <h3>Favorite Meals</h3>
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "foodhunter";
            $user_id = $_GET['id'];

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
                    echo '<img src="images/' . $row["image"] . '" class="rpImg">';
                    echo '<div class="text-block color-secondary">';
                    echo '<a href="#">' . $row["name"] . '</a>';
                    echo '<span class="date">RM ' . $row["price"] . '</span>';
                    echo '<div class="mt-2">';
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
                            <h3>Tags</h3>
                            <div class="sidebar-tags color-secondary">
                                <a href="#">Recipes,</a>
                                <a href="#">Desserts,</a>
                                <a href="#">Menu,</a>
                                <a href="#">Cooking,</a>
                                <a href="#">Dinning,</a>
                                <a href="#">Food,</a>
                            </div>
                        </div><!--.categories-box-->
                    </div>
                </div><!--right-sidebar-->
            </div>
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
