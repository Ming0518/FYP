<?php
session_start();

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'foodhunter';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}

// Define the restaurant ID (replace this with the appropriate restaurant ID)
$restaurant_id = $_SESSION['matching_restaurant'];

// Prepare SQL query to fetch restaurant name and location
$stmt = $pdo->prepare("SELECT name, location, description, image_path FROM restaurants WHERE id = :id");
$stmt->bindParam(':id', $restaurant_id, PDO::PARAM_INT);
$stmt->execute();
$restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $restaurant['name'];
$location = $restaurant['location'];
$description = $restaurant['description'];
$imagePath = $restaurant['image_path'];

// Prepare SQL query to fetch meals for a specific restaurant ID
$stmt = $pdo->prepare("SELECT * FROM meals WHERE restaurant_id = :restaurant_id LIMIT 3");
$stmt->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
$stmt->execute();
$meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch comments for the specified restaurant ID
$stmt = $pdo->prepare("SELECT * FROM restaurant_comments WHERE restaurant_id = :restaurant_id ORDER BY created_at DESC");
$stmt->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to calculate distance between two coordinates
function calculate_distance($lat1, $lon1, $lat2, $lon2) {
    $earth_radius = 6371; // Earth's radius in kilometers
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat/2) * sin($dLat/2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distance = $earth_radius * $c;
    return $distance;
}

$user_lat = $_SESSION['latitude'] ?? null;
$user_lon = $_SESSION['longitude'] ?? null;
$session_user_id = $_SESSION['user_id'] ?? null;
?>
<?php
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>

<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" media="screen" href="superfish/css/superfish.css">
    <link rel="stylesheet" type="text/css" href="slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css">
    <script src="superfish/js/hoverIntent.js"></script>
    <script src="superfish/js/superfish.js"></script>
    <style>
    .button-container {
        text-align: center;
        margin-top: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 40px;
        cursor: pointer;
        font-size: 16px;
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
                            <li class="nav-item active">
                                <a href="index.html" class="nav-link" data-effect="Home">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="reservation.html" class="nav-link"
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
                    </button>
                </nav>
            </div><!--.row-->
        </div>
    </header>

    <section class="company-intro pt-60">
        <div class="container">
            <div class="row justify-content-center">
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
                    $restaurant_id = $_SESSION['matching_restaurant'];

                    // Prepare SQL query to fetch restaurant name, location, description, and image path
                    $stmt = $pdo->prepare("SELECT name, location, description, image_path FROM restaurants WHERE id = :id");

                    // Bind parameters
                    $stmt->bindParam(':id', $restaurant_id, PDO::PARAM_INT);

                    // Execute the query
                    $stmt->execute();

                    // Fetch the restaurant details
                    $restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Extract the name, location, description, and image path
                    $name = $restaurant['name'];
                    $location = $restaurant['location'];
                    $description = $restaurant['description'];
                    $imagePath = $restaurant['image_path'];

                    // Display the restaurant image
                    echo "<img src='images/restaurants/$imagePath' class='introImg'>";

                    // Close the database connection
                    $pdo = null;
                    ?>
                </div>

                <div class="text-content text-center heading dark col-md-5">
                    <?php
                    // Display the restaurant details
                    echo "<h2 class='section-title'><strong>$name</strong>$location</h2>";
                    echo "<div class='divider dark mb-4'>";
                    echo "<div class='icon-wrap'><i class='icon icon-spoon'></i></div>";
                    echo "</div>";
                    echo "<p>$description</p>";
                    ?>
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
                ?>
            </div><!-- box-wrap -->
        </div><!-- container -->
    </section>

    <div class="button-container">
        <button onclick="window.location.href='reservation.php';">Make a Reservation</button>
    </div>

    <div class="heading text-center">
        <h2 class="section-title text-center"><strong>Comment Section</strong></h2>
        <div class="divider dark mb-4">
            <div class="icon-wrap">
                <i class="icon icon-spoon"></i>
            </div>
        </div>
    </div>

    <section class="comments-section" style="background-color: #FDC4C4;">
        <div class="container">
            <div class="comments">
                <?php
                foreach ($comments as $comment) {
                    echo "<div class='comment'>";
                    echo "<p><strong>{$comment['name']}</strong> - {$comment['created_at']}";

                    if ($session_user_id === $comment['user_id']) {
                        echo " (Your comment)";
                    } elseif ($user_lat !== null && $user_lon !== null && $comment['latitude'] !== null && $comment['longitude'] !== null) {
                        $distance = calculate_distance($user_lat, $user_lon, $comment['latitude'], $comment['longitude']);
                        echo " (Distance from you: " . round($distance, 2) . " km)";
                    }

                    echo "</p><p>{$comment['comment']}</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </section>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="content">
            <div class="copyright">
                <p>© 2024 - FOOD HUNTER</p>
            </div>
            <div class="payment-card">
                <img src="images/visa.png" class="cardImg">
                <img src="images/american-express.png" class="cardImg">
                <img src="images/master-card.png" class="cardImg">
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
