<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="style3.css" rel="stylesheet">
    <link href="quickbar.css" rel="stylesheet">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "CREATE DATABASE IF NOT EXISTS group_project";
        $conn->query($sql);
        $dbname = "group_project";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "CREATE TABLE IF NOT EXISTS reservation_times (
                id INT AUTO_INCREMENT PRIMARY KEY,              
                date DATE NOT NULL,
                time TIME NOT NULL,
                guests INT NOT NULL,
                adults INT NOT NULL,
                children INT NOT NULL,
                babies INT NOT NULL,
                notes CHAR(200) NOT NULL,
                meal_period VARCHAR(100) NOT NULL,
                user_name VARCHAR(100) NOT NULL,
                user_email VARCHAR(100) NOT NULL
            )";
        $conn->query($sql);
        $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
        $conn->query($sql);        

        $sql = "CREATE TABLE IF NOT EXISTS subscribers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(100) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        $conn->query($sql);   
        
        $sql = "CREATE TABLE IF NOT EXISTS 
            offer (id INT AUTO_INCREMENT PRIMARY KEY, 
            offer_name VARCHAR(255) NOT NULL,offer_desc TEXT(1000) NOT NULL,
            offer_image VARCHAR(255) NOT NULL,
            offer_desc2 TEXT(1000) NOT NULL,
            offer_period TEXT(100) NOT NULL)";
        
        $conn->query($sql);   
        
        $sql = "CREATE TABLE IF NOT EXISTS 
                contactus (id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                number VARCHAR(50) NOT NULL,
                message TEXT(500) NOT NULL,
                created_at TIMESTAMP NOT NULL)";
        
        $conn->query($sql);  
        
        $sql = "CREATE TABLE IF NOT EXISTS cvs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            role VARCHAR(50) NOT NULL,
            cv_file VARCHAR(255) NOT NULL
        )";
        
       $conn->query($sql);  
        
        $conn->close();
    ?>
    <style>
        #logout-button{
            border-color: white;
            background-color: transparent
        }
        #logout-button:hover{
            background-color: #FFF;
        }
        
        #profile-button{
            border-color: white;
            background-color: transparent
        }
        #profile-button:hover{
            background-color: #FFF;
        }
        .carousel-item {
            height: 85vh;
            background-size: cover;
            background-position: center;
        }
        .carousel-caption {
            bottom: 50%;
            transform: translateY(50%);
        }
        .custom-section {
            padding: 20px 0px 20px 0px;
            background-color: #333;
        }
        .custom-section img {
            max-width: 300px;
            height: auto;
        }
        .custom-section p {
            margin-top: 20px;
            font-size: 20px;
            text-align: start;
        }
        .custom_container {
             background-color: #333;
             padding: 40px 0;
        }
    </style>
</head>
<body>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#" style="color: white;">Logo</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-1 change">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="menu.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="offers.php">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="contactus.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="join_us.php">Join us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="./reservation.php">Reservation</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if (isset($_SESSION['user_name'])): ?>
                <div class="d-flex align-items-center">
                    <span class="me-3" style="color: white;"><?php echo $_SESSION['user_name']; ?></span>
                    <a href="#" class="btn btn-outline-light me-2" id="profile-button" data-bs-toggle="modal" data-bs-target="#profileModal" style="">Profile</a>
                    <a href="logout.php" class="btn btn-outline-light" id="logout-button" style="">Logout</a>
                </div>
            <?php else: ?>
                <a href="login.php" class="login-button">Login</a>
            <?php endif; ?>
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- End Navbar -->
    
    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="profileContent">
                        <!-- Profile content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hero Section with Carousel -->
    <section class="hero-section" style="background: url(./hero/hero-bg-1.jpeg) no-repeat center center / cover; height: 100vh; display: flex; flex-direction: column; color: white;">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Taste the Difference!</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Experience Exquisite Flavors!</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Delight in Every Bite!</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>A Culinary Adventure Awaits!</h1>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- End Hero Section -->
    
    <div class="custom_container">
        <!-- First Section -->
        <section class="custom-section">
            <div class="container text-center text-white">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4">
                        <img src="offerImages/res2.jpg" alt="Descriptive Text" class="img-fluid rounded">
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">Our Culinary Heritage: A Restaurant History</h2>
                        <p>In the heart of Myanmar's bustling streets, a small yet charming restaurant stands 
                            as a testament to Burmese culinary heritage.Established over half a century ago, 
                            this traditional eatery was founded by a local family passionate about preserving 
                            and sharing the rich flavors of their homeland. The restaurant's interior, adorned 
                            with vibrant Burmese tapestries and handcrafted wooden furniture, 
                            exudes a warm and inviting atmosphere.With recipes passed down through generations, 
                            our restaurant continues to delight customers with classic Burmese dishes.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="row small-section text-white">
        <div class="col-4 flex-center-all">
            <h2>Quick Access Menu</h2>
        </div>
        <div class="col-2 flex-center-all flex-column light-orange-bg bob-wrapper hvr-bob">
            <a class="inherit-link full-width full-height flex-center-all" href="offers.php">
                <img class="bob" src="offerImages/discount.png">
                <p class="no-padding no-margin">Offers</p>
            </a>        
        </div>
        <div class="col-2 flex-center-all flex-column bob-wrapper hvr-bob">
            <a class="inherit-link full-width full-height flex-center-all" href="reservation.php">            
                <img class="bob" src="offerImages/booking.png">
                <p class="no-padding no-margin">Reservations</p>
            </a>        
        </div>
        <div class="col-2 flex-center-all flex-column light-orange-bg bob-wrapper hvr-bob">
            <a class="inherit-link full-width full-height flex-center-all" href="contactus.php">
                <img class="bob" src="offerImages/contact.png">
                <p class="no-padding no-margin">Contact Us</p>
            </a>
        </div>
        <div class="col-2 flex-center-all flex-column bob-wrapper hvr-bob">
            <a class="inherit-link full-width full-height flex-center-all" href="menu.php">            
                <img class="bob" src="offerImages/menu.png">
                <p class="no-padding no-margin">Menu</p>
            </a>        
        </div>
    </div>
    
    <div class="section-container">
        <div class="container text-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="section-title">Delight in culinary companionship</h2>
                    <p class="section-description">
                            Embark on a culinary journey through Myanmar with our menu. Begin with the iconic 
                            Tea Leaf Salad, a tantalizing combination of flavors and textures. Savor the comforting 
                            warmth of Mohinga, our nation’s beloved noodle soup, any time of day. Complete your meal 
                            with the refreshing sweetness of Shwe Yin Aye, 
                            a tropical dessert delight. Every dish offers an authentic taste of Burma.                
                    </p>
                    <a href="menu.php" class="btn btn-primary">View Menus</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="section-container2">
        <div class="container text-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="section-title2">Enjoy exclusive deals and elevate every visit.</h2>
                    <p class="section-description2">
                            Save up to 20% on your Mediterranean feast!
                            Experience the authentic tastes of Myanmar, reimagined with a modern twist. Our dishes are crafted with the finest ingredients, promising an unforgettable culinary adventure.
                            Enjoy 15% off with a $50 dining voucher or 20% off with a $100 voucher. Purchase yours now!              
                    </p>
                    <a href="offers.php" class="btn btn-primary">View More Offers</a>
                </div>     
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="footer-column">
                <h3>Restaurant Name</h3>
                <p>Restaurant address (postal code)</p>
                <p>+65 xxxxxxxx</p>
                <p>example.email@gmail.com</p>
                <div class="logo">
                    <span>LOGO</span>
                </div>
            </div>
            <div class="footer-column">
                <h3>Opening Hours</h3>
                <p>Breakfast, Daily<br>6:30am to 10:30am</p>
                <p>Lunch, Daily<br>12:00pm to 2:30pm</p>
                <p>Saturday Brunch, Sat<br>12:00pm to 3:00pm</p>
                <p>Dinner, Sun to Thu<br>6:00pm to 10:00pm</p>
                <p>Dinner, Fri, Sat & Eve of PH<br>6:00pm to 10:30pm</p>
                <p>Special Menu, Fri, Sat & Sun</p>
            </div>
            <div class="footer-column newsletter">
                <h3>Newsletter</h3>
                <form action="subscribe.php" method="post" id="subscribeForm">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <p>Links to social media</p>
                <h3>FAQ</h3>
                <p><a href="#">Terms and conditions</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Name. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profile-button');
            profileButton.addEventListener('click', function() {
                fetch('fetch_reservation_details.php')
                    .then(response => response.json())
                    .then(data => {
                        let profileContent = document.getElementById('profileContent');
                        if (data.success) {
                            let reservation = data.reservation;
                            profileContent.innerHTML = `
                                <p><strong>Date:</strong> ${reservation.date}</p>
                                <p><strong>Time:</strong> ${reservation.time}</p>
                                <p><strong>Guests:</strong> ${reservation.guests}</p>
                                <p><strong>Notes:</strong> ${reservation.notes}</p>
                            `;
                        } else {
                            profileContent.innerHTML = '<p>No active reservations found.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching reservation details:', error);
                        document.getElementById('profileContent').innerHTML = '<p>Error fetching reservation details.</p>';
                    });
            });
        });

        document.getElementById('subscribeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const email = event.target.email.value;
            fetch('subscribe.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
