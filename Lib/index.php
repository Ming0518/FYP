<?php
session_start();
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
                        </div>
                        <button class="btn btn-outline-light light hvr-sweep-to-right" id="loginButton" onclick="login()">
                            <a href="login.php">Login</a>
                        </button>
                        <button class="btn btn-outline-light light hvr-sweep-to-right" id="logoutButton" onclick="logout()">
                            Logout
                        </button>
                        <button class="btn btn-outline-light light hvr-sweep-to-right" id="registerButton">
                            <a href="register.php">Register</a>
                        </button>
                    </nav>
                </div>
            </div>
        </header>
        <section id="billboard">
            <div class="container text-center">
                <div class="text-content heading text-center light">
                    <h1 class="section-title"><strong>Welcome To</strong> FOOD HUNTER</h1>
                    <div class="divider">
                        <div class="icon-wrap">
                            <i class="icon icon-spoon"></i>
                        </div>
                    </div>
                    <div class="slogan mb-5">FIND THE BEST Hyperlocal Foodies' Experience</div>
                </div>
                <div class="search-bar">
                    <form class="search-form" method="get" action="result_store.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <select id="location" name="location">
                                <option value="">Select Location</option>
                                <option value="Alor Setar City Center">Alor Setar City Center</option>
                                <option value="Taman Bandaraya">Taman Bandaraya</option>
                                <option value="Anak Bukit">Anak Bukit</option>
                                <option value="Taman Rakyat">Taman Rakyat</option>
                                <option value="Taman Saujana">Taman Saujana</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select id="category" name="category">
                                <option value="">Select Category</option>
                                <option value="Pet-Friendly">Pet-Friendly</option>
                                <option value="Private Dining Rooms">Private Dining Rooms</option>
                                <option value="Live Music">Live Music</option>
                                <option value="Wheelchair Accessible">Wheelchair Accessible</option>
                                <option value="Outdoor Seating">Outdoor Seating</option>
                            </select>
                        </div>
                        <button type="submit" class="button btn-effect" id="searchButton">Search</button>
                    </form>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer-bottom">
                <div class="container">
                    <div class="content">
                        <div class="copyright">
                            <p>© 2024 - FOOD HUNTER </p>
                        </div>
                        <div class="payment-card">
                            <img src="images/visa.png" class="cardImg">
                            <img src="images/american-express.png" class="cardImg">
                            <img src="images/master-card.png" class="cardImg">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
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
                responsive: [
                    {
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

            // Function to check login state
            function checkLoginState() {
                if (localStorage.getItem('isLoggedIn') === 'true') {
                    document.getElementById('loginButton').style.display = 'none';
                    document.getElementById('registerButton').style.display = 'none';
                    document.getElementById('profileLink').style.display = 'block';
                    document.getElementById('logoutButton').style.display = 'block';
                    document.getElementById('searchButton').disabled = false;
                } else {
                    document.getElementById('loginButton').style.display = 'block';
                    document.getElementById('registerButton').style.display = 'block';
                    document.getElementById('profileLink').style.display = 'none';
                    document.getElementById('logoutButton').style.display = 'none';
                    document.getElementById('searchButton').disabled = true;
                }
            }

            // Run checkLoginState when page loads
            window.onload = checkLoginState;

            // Function to handle navigation clicks
            $('.navbar-nav a').on('click', function (event) {
                if (!localStorage.getItem('isLoggedIn')) {
                    event.preventDefault();
                    alert('Please login first.');
                }
            });

            $('#searchButton').on('click', function (event) {
                if (!localStorage.getItem('isLoggedIn')) {
                    event.preventDefault();
                    alert('Please login first.');
                }
            });
        });

        // Function to handle logout
        function logout() {
            localStorage.removeItem('isLoggedIn');
            window.location.reload();
        }

        // Function to validate form
        function validateForm() {
            var category = document.getElementById("category").value;
			var location = document.getElementById("location").value;

            if (category === "") {
                alert("Please select a category.");
                return false;
            }
			if (location === "") {
                alert("Please select a location.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
