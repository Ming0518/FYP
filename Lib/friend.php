<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Search and Add Friend</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" media="screen" href="superfish/css/superfish.css">
    <script src="superfish/js/hoverIntent.js"></script>
    <script src="superfish/js/superfish.js"></script>
    <style>
        .search-results, .friend-list {
            margin-top: 20px;
        }
        .friend-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .btn-add-friend {
            background-color: #28a745;
            color: white;
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
				</div><!----.row----->

			</div>
		</header>
        
        <div class="page-banner">
            <div class="text-content bright heading text-center light">
                <h1 class="section-title"><strong>Search</strong> and Add Friends</h1>
                <div class="divider mb-4">
                    <div class="icon-wrap">
                        <i class="icon icon-spoon"></i>
                    </div>
                </div>
                <div class="slogan mb-5">Find and add your friends to stay connected</div>
            </div>
        </div>

        <section class="friend-page">
            <div class="container mt-sm-5 mt-6">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="search-bar-box">
                            <h3>Search for Friends</h3>
                            <form id="searchForm">
                                <div class="form-group dark">
                                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Type a name">
                                    <button type="button" class="searchbtn" onclick="searchFriends()"><i class="icon icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="search-results">
                            <h3>Search Results</h3>
                            <div id="results"></div>
                        </div>
                        <!-- <div class="friend-list">
                            <h3>Friend List</h3>
                            <div id="friendList"></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>

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

    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <script>
        function searchFriends() {

    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const results = document.getElementById('results');
    results.innerHTML = '';

    fetch('search_friends.php?query=' + searchInput)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
    console.log(data); // Add this line to log the data to the console
    if ( data.length === 0) {
        results.innerHTML = '<p>No results found.</p>';
    } else {
        data.users.forEach(user => { // Assuming 'users' is the key containing the array in your JSON response
            const div = document.createElement('div');
            div.className = 'result-item';
            div.innerHTML = `
            <a href="profile.php?username=${user.username}" onclick="goToProfile(event)">${user.username}</a>
                <span class="distance">Distance: ${user.distance.toFixed(2)} km</span>
                <button class="btn btn-success ml-3" onclick="addFriend(${user.id})">Add Friend</button>
            `;
            results.appendChild(div);
        });
    }
})

        .catch(error => {
            console.error('Error fetching search results:', error);
            results.innerHTML = '<p>Error fetching search results.</p>';
        });
}

function goToProfile(event) {
    event.preventDefault(); // Prevent default anchor behavior (page reload)
    const username = event.target.textContent; // Get the clicked username
    window.location.href = `splash.php`; // Redirect to profile page
}
        function addFriend(id) {
            fetch('add_friend.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Friend added successfully!');
                    updateFriendList();
                } else {
                    alert('Error adding friend.');
                }
            })
            .catch(error => {
                console.error('Error adding friend:', error);
                alert('Error adding friend.');
            });
        }

        function updateFriendList() {
            fetch('get_friends.php')
                .then(response => response.json())
                .then(data => {
                    const friendList = document.getElementById('friendList');
                    friendList.innerHTML = '';

                    data.forEach(friend => {
                        const div = document.createElement('div');
                        div.className = 'friend-item';
                        div.innerText = friend.name;
                        friendList.appendChild(div);
                    });
                })
                .catch(error => {
                    console.error('Error fetching friend list:', error);
                });
        }
    </script>
</body>
</html>
