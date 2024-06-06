<?php
session_start();
?>
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

       
<?php
if (isset($_SESSION['comment_success'])) {
    // Unset the session variable
    unset($_SESSION['comment_success']);
    // Display the success message and redirect using JavaScript
    echo "<script>
        alert('Comment submitted successfully!');
        window.location.href = 'index.php';
    </script>";
}
?>

    
                    
        <!-- Remaining HTML content -->
        <section class="comments-section" style="background-color: #FDC4C4;">
    <div class="container">
        <div class="comment-form">
            <h3>Add a Comment</h3>
            <form method="post" action="submit_restaurant_comment.php">
                <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id; ?>">
                <!-- <input type="hidden" name="latitude" value="<?php echo $_SESSION['user_lat']; ?>">
                <input type="hidden" name="longitude" value="<?php echo $_SESSION['user_lon']; ?>"> -->
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
