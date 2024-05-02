<!DOCTYPE html>
<html>
<style>

.button-container {
    text-align: center; /* Center the button horizontally */
    margin-top: 20px; /* Add space on top */
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 40px;
    cursor: pointer;
    font-size: 16px;
}
</style>
<head>
    <title>Food Hunter</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--link to the CSS files for this menu type-->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" media="screen" href="superfish/css/superfish.css">

    <link rel="stylesheet" type="text/css" href="slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick/slick-theme.css" />

    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css">

    <!--link to the JavaScript files (hoverIntent is optional)-->
    <script src="superfish/js/hoverIntent.js"></script>
    <script src="superfish/js/superfish.js"></script>

</head>

<body>

    <div class="main-wrapper">
        <header id="header-wrap">
            <div class="container">

            
            <?php
            if (isset($_GET['success'])) {
                if ($_GET['success'] == '1') {
                    echo '<div class="alert alert-success">Comment submitted successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Failed to submit the comment.</div>';
                }
            }
            ?>
                <div class="row">
                    <nav class="navbar navbar-expand-lg col-md-12">

                        <div class="navbar-brand">
                            <a href="index.html">
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
                                <!-- <li class="nav-item active">
                                    <a href="index.html" class="nav-link" data-effect="Home">HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a href="reservation.html" class="nav-link"
                                        data-effect="Reservation">RESTAURANTS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="menu.html" class="nav-link" data-effect="Menu">MENU</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" data-effect="Blog" class="nav-link" class="dropdown-toggle">RATE & REVIEW</a>

                                </li>
                                <li class="nav-item">
                                    <a href="https://templatesjungle.gumroad.com/l/hungerhunt-free-responsive-html-css-template"
                                        target="_blank" class="nav-link" data-effect="Menu"> <b>PROFILE</b> </a>
                                </li> -->
                            </ul>

                        </div><!--navbar-collapse-->



                    </nav>
                </div><!----.row----->

            </div>
        </header>


        <section class="company-intro pt-60">
            <div class="container">
                <div class="row justify-content-center"> <!-- Added 'row' class for Bootstrap grid system -->
                    <div class="text-content text-center heading dark col-md-5">
                        <div class="icon-wrap">
                            <i class="icon icon-spoon"></i>
                        </div>
                        <div class="icon-wrap">
                            <i class="icon icon-spoon"></i>
                        </div>
                        <div class="icon-wrap">
                            <i class="icon icon-spoon"></i>
                        </div>
                        <h2 class="section-title">
                            <strong>Result </strong>the best choice for you
                        </h2>
                        <div class="divider dark mb-4">
                            <div class="icon-wrap">
                                <i class="icon icon-spoon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="company-intro pt-60">
            <div class="container">
                <div class="row ">

                <div class="section-image col-md-7">
					<img src="images/Kopitiam-1.jpg" class="introImg">
				</div>

                    <div class="text-content text-center heading dark col-md-5">
                        <!-- PHP code to fetch and display restaurant description -->
                        <?php
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
                            die("Error: Could not connect. " . $e->getMessage());
                        }

                        // Define the restaurant ID (replace this with the appropriate restaurant ID)
                        $restaurant_id = 1; // Example ID

                        // Prepare SQL query to fetch restaurant description
                        $stmt = $pdo->prepare("SELECT description FROM restaurants WHERE id = :id");

                        // Bind parameters
                        $stmt->bindParam(':id', $restaurant_id, PDO::PARAM_INT);

                        // Execute the query
                        $stmt->execute();

                        // Fetch the restaurant description
                        $restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Extract the description
                        $description = $restaurant['description'];

                        // Display the restaurant description
                        echo "<h2 class='section-title'><strong>Seng Kopitiam</strong>Kedah, Changlun</h2>";
                        echo "<div class='divider dark mb-4'>";
                        echo "<div class='icon-wrap'><i class='icon icon-spoon'></i></div>";
                        echo "</div>";
                        echo "<p>$description</p>";

                        // Close the database connection
                        $pdo = null;
                        ?>
                        <!-- End of PHP code -->
                    </div>
                </div>
            </div>
        </section>

        <section class="text-center featured-food-wrap heading">
    <div class="container">
        <h2 class="section-title"><strong>Ranking</strong> Best Meals Recommendation</h2>
        <div class="divider dark mb-4">
            <div class="icon-wrap">
                <i class="icon icon-spoon"></i>
            </div>
        </div>
        <div class="box-wrap slider">
            <?php
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
                die("Error: Could not connect. " . $e->getMessage());
            }

            // Prepare SQL query to fetch meals for a specific restaurant ID
            $stmt = $pdo->prepare("SELECT * FROM meals WHERE restaurant_id = :restaurant_id LIMIT 3");

            // Define the restaurant ID
            $restaurant_id = 1; // Change this to the desired restaurant ID

            // Bind parameters
            $stmt->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the meals for the specified restaurant ID
            $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display the meals
            foreach ($meals as $meal) {
                echo '<div class="col-md-4 row-cols-sm-1 box">';
                echo '<figure>';
                echo '<a href="#">';
                echo "<img src='images/{$meal['img']}' alt='{$meal['name']}'>";
                echo '</a>';
                echo '</figure>';
                echo '<div class="text-content text-align">';
                echo '<div class="content">';
                echo "<h3><a href='#'>{$meal['name']}</a></h3>";
                echo '</div>';
                echo "<span class='price-tags'>RM {$meal['price']}</span>";
                echo '</div>';
                echo '</div>';
            }

            // Close the database connection
            $pdo = null;
            ?>
        </div><!-- box-wrap -->
    </div><!-- container -->
</section>

<div class="heading text-center">
				<h2 class="section-title text-center"><strong>Comment Section</strong></h2>
				<div class="divider dark mb-4">
					<div class="icon-wrap">
						<i class="icon icon-spoon"></i>
					</div>
				</div>
			</div>
                    
        <!-- Remaining HTML content -->
        <section class="comments-section" style="background-color: #DF9A9A;">
    <div class="container">
        
        <div class="comments">
            <?php
            require_once 'db_connection.php';

            // Fetch comments for the specified restaurant ID
            
            $stmt = $pdo->prepare("SELECT * FROM restaurant_comments WHERE restaurant_id = :restaurant_id ORDER BY created_at DESC");
            $stmt->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display comments
            foreach ($comments as $comment) {
                echo "<div class='comment'>";
                echo "<p><strong>{$comment['name']}</strong> - {$comment['created_at']}</p>";
                echo "<p>{$comment['comment']}</p>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="comment-form">
    <h3>Add a Comment</h3>
    <form method="post" action="submit_restaurant_comment.php">
        <!-- Hidden input field to store the restaurant ID -->
        <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" rows="4" required></textarea>
        </div>
        
        <div class="button-container">
    <button type="submit" class="custom-button">Submit</button>
</div>
    </form>
</div>

    </div>
</section>

    </div>




    
    <div class="footer-bottom">
		<div class="container">
			<div class="content">
				<div class="copyright">
					<p>© 22024 - FOOD HUNTER</p>
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

    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="slick/slick/slick.min.js"></script>

    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>

    <script>
        $(document).ready(function () {
            $('a.fancybox').fancybox({
                openEffect: 'true',
                closeEffect: 'none',
                prevEffect: 'none',
                nextEffect: 'true',
                closeBtn: true,
                helpers: {
                    title: {
                        type: 'inside'
                    },
                    buttons: {}
                }
            });


            $('.slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            arrows: false,
                            dots: true,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '20px',
                            autoplay: false,
                        }
                    }
                ]
            });

        });
    </script>

</body>

</html>
