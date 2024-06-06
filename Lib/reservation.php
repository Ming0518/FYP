<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reservation</title>

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
        .page-banner {
            height: 450px; /* Adjust the height as needed */
            background-size: cover; /* Ensures the background image covers the container */
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

					<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#slide-navbar-collapse" aria-controls="slide-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"><i class="icon icon-navicon"></i></span>
					</button>

					<div class="navbar-collapse collapse" id="slide-navbar-collapse">
						<ul class="navbar-nav light list-inline strong sf-menu">
							<li class="nav-item active">
								<a href="index.html" class="nav-link" data-effect="Home">HOME</a>
							</li>
							<li class="nav-item">
								<a href="reservation.html" class="nav-link"
									data-effect="Reservation">RESERVATION</a>
							</li>
							<li class="nav-item">
								<a href="menu.html" class="nav-link" data-effect="Menu">MENU</a>
							</li>
							<li class="dropdown-submenu">
								<a href="#" data-effect="Blog" class="nav-link" class="dropdown-toggle">BLOG</a>
								<ul class="dropdown-menu">
									<li class="nav-item">
										<a href="blog1.html" class="hvr-sweep-to-right">BLOG 1</a>
									</li>
									<li class="nav-item">
										<a href="blog2.html" class="hvr-sweep-to-right">BLOG 2</a>
									</li>
								</ul>
							</li>
							<li class="dropdown-submenu">
								<a href="#" data-effect="Blog" class="nav-link" class="dropdown-toggle">PAGES</a>
								<ul class="dropdown-menu">
									<li class="nav-item">
										<a href="menu.html" class="hvr-sweep-to-right">MENU <span>(pro)</span> </a>
									</li>
									<li class="nav-item">
										<a href="reservation.html" class="hvr-sweep-to-right">RESERVATION <span>(pro)</span> </a>
									</li>
									<li class="nav-item">
										<a href="blog1.html" class="hvr-sweep-to-right">BLOG 1 <span>(pro)</span> </a>
									</li>
									<li class="nav-item">
										<a href="blog2.html" class="hvr-sweep-to-right">BLOG 2 <span>(pro)</span> </a>
									</li>
									<li class="nav-item">
										<a href="single-blog.html" class="hvr-sweep-to-right">SINGLE BLOG <span>(pro)</span> </a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="https://templatesjungle.gumroad.com/l/hungerhunt-free-responsive-html-css-template" class="nav-link" data-effect="Menu" target="_blank"> <b>GET PRO</b>  </a>
							</li>
						</ul>

					</div><!--navbar-collapse-->

					<div class="social-block">	
						<div class="social-icon">
							<a href="facebook.com">
								<i class="icon icon-facebook"></i>
							</a>
							<a href="twitter.com">
								<i class="icon icon-twitter"></i>
							</a>
							<a href="instagram.com">
								<i class="icon icon-instagram"></i>
							</a>
						</div>
					</div>

				</nav>
				</div><!-- .row -->

			</div>
		</header>

<div class="page-banner">
	<div class="text-content bright heading text-center light">
		<h1 class="section-title"><strong>Create</strong> reservation</h1>
		<div class="divider">
			<div class="icon-wrap">
				<i class="icon icon-spoon"></i>
			</div>
		</div>
		<div class="slogan mb-5">book now for the best experience in table</div>
	</div>
</div><!--page-banner-->

<section class="online-booking heading text-center mb-5">
	<div class="footer-bottom">
        
		<h2 class="section-title text-center"><strong>Make Your </strong>online booking</h2>
		<div class="divider dark mb-4">
			<div class="icon-wrap">
				<i class="icon icon-spoon"></i>
			</div>
		</div>
			<div class="search-bar mb-xlarge">
            <form class="search-form" method="post" action="process_reservation.php">
    <div class="form-group">
        <div class="select">
            <input type="date" class="form-control" name="reservation_date" required>
        </div>
    </div>
    <div class="form-group">
        <div class="select">
            <input type="time" class="form-control" name="reservation_time" required>
        </div>
    </div>
    <div class="form-group no-border">
        <div class="select">
            <input type="number" class="form-control" min="1" max="20" placeholder="Number of People" name="number_of_people" required>
        </div>
    </div>
    <button class="button btn-effect" type="submit" name="submit_reservation">Book Now</button>
</form>

	</div><!--search-bar-->
		
	</div>
</section>

<footer>
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
</footer> 

</div>

	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
