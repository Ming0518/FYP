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
									<a href="rate.html" data-effect="Blog" class="nav-link" class="dropdown-toggle">RATE & REVIEW</a>
				
								</li>
								<li class="nav-item">
									<a href="profile.php" target="_blank" class="nav-link" data-effect="Menu"> <b>PROFILE</b>  </a>
								</li> -->
							</ul>

						</div><!--navbar-collapse-->

						<button class="btn btn-outline-light light hvr-sweep-to-right" id="loginButton" onclick="login()">
							<a href="login.php">Login</a>
						</button>

						<button class="btn btn-outline-light light hvr-sweep-to-right" id="logoutButton" onclick="logout()">
							Logout
						</button>
						
						
						<button class="btn btn-outline-light light hvr-sweep-to-right" id="registerButton">
							<a href="register.php">Register</a>
						</button>
						
						<button class="btn btn-outline-light light hvr-sweep-to-right" id="profileLink" style="display: none;">
							<a href="profile.php">Profile</a>
						</button>
						
						</button>

					</nav>
				</div><!----.row----->

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
					<form class="search-form">
						<div class="form-group">
							<div class="select">
								<select>
									<option value="none">Sushi</option>
									<option value="none">Dim sum</option>
									<option value="none">Seafood</option>
									<option value="none">Burger</option>
									<option value="none">Sandwich</option>
									<option value="none">Nasik</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="select">
								<select>
									<option value="none">Animal Friendly</option>
									<option value="none">9:00 pm</option>
									<option value="none">10:00 pm</option>
									<option value="none">11:00 pm</option>
									<option value="none">12:00 pm</option>
								</select>
							</div>
						</div>

						<div class="form-group no-border">
							<div class="select">
								<select>
									<option value="none">WiFi Available</option>
									<option value="none">Air conditioning</option>
									<option value="none">WiFi Available</option>
									<option value="none">Pets in the house</option>
									<option value="none">Wheelchair accessible</option>
								</select>
							</div>
						</div>

						<button class="button btn-effect" type="button" onclick="redirectToResultPage()" id="searchButton">
						<a href="example.php">Search</a>

						</button>

						<script>
							function redirectToResultPage() {
    // Get selected preferences
    var restaurantPreference = document.getElementById('restaurantPreference').value;
    var foodType = document.getElementById('foodType').value;
    var otherOptions = document.getElementById('otherOptions').value;

    // Redirect to result page with selected preferences as query parameters
    window.location.href = 'result.php?restaurant=' + restaurantPreference + '&food=' + foodType + '&options=' + otherOptions;
}

						</script>					</form>

				</div>

			</div><!----billboard-content----->


		</div><!--billboard-->

	
	</footer>

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

		});

		$(document).ready(function () {
        // Other JavaScript code



        

        // Function to check login state
        function checkLoginState() {
            if (localStorage.getItem('isLoggedIn') === 'true') {
                // User is logged in, show profile button and logout button
                document.getElementById('loginButton').style.display = 'none';
                document.getElementById('registerButton').style.display = 'none';
                document.getElementById('profileLink').style.display = 'block';
                document.getElementById('logoutButton').style.display = 'block';
				document.getElementById('searchButton').disabled = false; // Enable search button

            } else {
                // User is not logged in, show login and register buttons
                document.getElementById('loginButton').style.display = 'block';
                document.getElementById('registerButton').style.display = 'block';
                document.getElementById('profileLink').style.display = 'none';
                document.getElementById('logoutButton').style.display = 'none';
				document.getElementById('searchButton').disabled = true; // Disable search button

            }
        }


// Run checkLoginState when page loads
window.onload = checkLoginState;


        // Function to handle navigation clicks
        $('.navbar-nav a').on('click', function (event) {
            if (!localStorage.getItem('isLoggedIn')) {
                event.preventDefault(); // Prevent default link behavior
                alert('Please login first.'); // Alert user to login first
            }
        });

   $('#searchButton').on('click', function (event) {
            if (!localStorage.getItem('isLoggedIn')) {
                event.preventDefault(); // Prevent default button behavior
                alert('Please login first.'); // Alert user to login first
            }
        });
    });




// Function to handle logout
function logout() {
    // Perform logout actions, such as clearing session data

    // Clear login state
    localStorage.removeItem('isLoggedIn');
    
    // Redirect or update UI as needed
    window.location.reload(); // Example: reload the current page
}


	</script>

</body>

</html>
