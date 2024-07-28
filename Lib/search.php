<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Search and Add Restaurant</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" media="screen" href="superfish/css/superfish.css">
    <script src="superfish/js/hoverIntent.js"></script>
    <script src="superfish/js/superfish.js"></script>
    <style>
        .search-results, .restaurant-list {
            margin-top: 20px;
        }
        .restaurant-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .restaurant-card {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 15px;
            text-align: center;
        }
        .restaurant-card img {
            max-width: 100%;
            height: auto;
        }
        .btn-add-restaurant {
            background-color: #28a745;
            color: white;
        }
        .filter-section {
            margin-bottom: 20px;
        }
        .filter-section select {
            margin-right: 10px;
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
                <h1 class="section-title"><strong>Search</strong> and Add Restaurants</h1>
                <div class="divider mb-4">
                    <div class="icon-wrap">
                        <i class="icon icon-spoon"></i>
                    </div>
                </div>
                <div class="slogan mb-5">Find and add restaurants to your list</div>
            </div>
        </div>

        <section class="restaurant-page">
            <div class="container mt-sm-5 mt-6">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="search-bar-box">
                            <h3>Search for Restaurants</h3>
                            <form id="searchForm">
                                <div class="form-group dark">
                                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Type a restaurant name">
                                    <button type="button" class="searchbtn" onclick="searchRestaurants()"><i class="icon icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="search-results">
                            <h3>Search Results</h3>
                            <div id="results"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="restaurant-list">
            <div class="container mt-5">
                <div class="filter-section">
                    <h3>All Restaurants</h3>
                    <select id="locationFilter" onchange="filterRestaurants()">
                        <option value="">All Locations</option>
                        <option value="Alor Setar City Center">Alor Setar City Center</option>
                                <option value="Taman Bandaraya">Taman Bandaraya</option>
                                <option value="Anak Bukit">Anak Bukit</option>
                                <option value="Taman Rakyat">Taman Rakyat</option>
                                <option value="Taman Saujana">Taman Saujana</option>                    </select>
                    <select id="categoryFilter" onchange="filterRestaurants()">
                        <option value="">All Categories</option>
                        <option value="Pet-Friendly">Pet-Friendly</option>
                                <option value="Private Dining Rooms">Private Dining Rooms</option>
                                <option value="Live Music">Live Music</option>
                                <option value="Wheelchair Accessible">Wheelchair Accessible</option>
                                <option value="Outdoor Seating">Outdoor Seating</option>                    </select>
                </div>
                <div class="row" id="restaurantGrid">
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

    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchRestaurants();
    });

    function searchRestaurants() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const results = document.getElementById('results');
        results.innerHTML = '';

        fetch('search_restaurants.php?query=' + searchInput)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Log the data to the console
                if (data.restaurants.length === 0) {
                    results.innerHTML = '<p>No results found.</p>';
                } else {
                    data.restaurants.forEach(restaurant => {
                        const div = document.createElement('div');
                        div.className = 'result-item';
                        div.innerHTML = `
                            <a href="example.php?id=${restaurant.id}" onclick="goToProfile(event, ${restaurant.id})">${restaurant.name}</a>
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

    function fetchRestaurants() {
        fetch('fetch_restaurants.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the data to the console
                const restaurantGrid = document.getElementById('restaurantGrid');
                const locationFilter = document.getElementById('locationFilter');
                const categoryFilter = document.getElementById('categoryFilter');

                // Populate filter options
                const locations = new Set();
                const categories = new Set();
                data.restaurants.forEach(restaurant => {
                    locations.add(restaurant.location);
                    categories.add(restaurant.category);
                });

                locations.forEach(location => {
                    const option = document.createElement('option');
                    option.value = location;
                    option.textContent = location;
                    locationFilter.appendChild(option);
                });

                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category;
                    option.textContent = category;
                    categoryFilter.appendChild(option);
                });

                // Populate restaurant grid
                restaurantGrid.innerHTML = '';
                data.restaurants.forEach(restaurant => {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-md-4';
                    colDiv.innerHTML = `
                        <div class="restaurant-card">
                            <img src="images/restaurants/${restaurant.image_path}" alt="${restaurant.name}">
                            <h4>${restaurant.name}</h4>
                            <p>${restaurant.location}</p>
                            <p>${restaurant.category}</p>
                            <a href="example.php?id=${restaurant.id}" class="btn btn-primary" onclick="goToProfile(event, ${restaurant.id})">View Details</a>
                        </div>
                    `;
                    restaurantGrid.appendChild(colDiv);
                });
            })
            .catch(error => console.error('Error fetching restaurants:', error));
    }

    function filterRestaurants() {
        const locationFilter = document.getElementById('locationFilter').value;
        const categoryFilter = document.getElementById('categoryFilter').value;
        const restaurantGrid = document.getElementById('restaurantGrid');
        restaurantGrid.innerHTML = '';

        fetch(`fetch_restaurants.php?location=${locationFilter}&category=${categoryFilter}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the data to the console
                data.restaurants.forEach(restaurant => {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-md-4';
                    colDiv.innerHTML = `
                        <div class="restaurant-card">
                            <img src="images/restaurants/${restaurant.image_path}" alt="${restaurant.name}">
                            <h4>${restaurant.name}</h4>
                            <p>${restaurant.location}</p>
                            <p>${restaurant.category}</p>
                            <a href="example.php?id=${restaurant.id}" class="btn btn-primary" onclick="goToProfile(event, ${restaurant.id})">View Details</a>
                        </div>
                    `;
                    restaurantGrid.appendChild(colDiv);
                });
            })
            .catch(error => console.error('Error filtering restaurants:', error));
    }

    function goToProfile(event, restaurantId) {
        event.preventDefault(); // Prevent default anchor behavior (page reload)

        // Save restaurant ID in the session
        fetch('save_restaurant_id.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ restaurantId: restaurantId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = `example.php?id=${restaurantId}`; // Redirect to profile page with restaurant ID
            } else {
                console.error('Error saving restaurant ID:', data.message);
            }
        })
        .catch(error => {
            console.error('Error saving restaurant ID:', error);
        });
    }
    </script>
</body>
</html>
