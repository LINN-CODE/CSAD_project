<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "group_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT * FROM offer";


$result= mysqli_query($conn,$sql);
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="offerCSS.css" rel="stylesheet">
</head>
<body style="background-color: #111">
        <!-- Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <!--Navbar-->
                 <nav class="navbar navbar-expand-lg fixed-top"  id="custom-navbar">
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
                      <a class="nav-link mx-lg-2 " aria-curre t="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mx-lg-2" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active mx-lg-2" href="#" >Offers</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="contactus.php">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="join_us.php" >Join us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="reservation.php">Reservation</a>
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
        <!--End Navbar-->
        
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

        <!--Hero Selection-->
        <section class="offer_section">
            <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
                <h1 class="offer-title">Burmese Generosity</h1><br>
                <p class="offer-description" style="font-style: italic">
        In Myanmar, sharing and generosity are deeply rooted in our culture. 
        We believe in the joy of giving and the abundance it brings. To honor this tradition,
        we're delighted to offer you special discounts and promotions,
        allowing you to savor the authentic flavors of Burma while experiencing the warmth of our hospitality.
        Join us as we celebrate the spirit of giving, one delicious dish at a time.
                    </p>
            </div>
        </section>
        
        <section class="offer-mid-section">
            <div class="container">
                <div class="offer-content text-center text-white">
                    <h1>OFFERS</h1><br>
                    <p class="offer-description" style="font-style: italic">
                        Immerse yourself in the warmth of Burmese hospitality and the spirit
                        of "dana"(giving) at our restaurant
                    </p>
                   
                </div>
            </div>
        </section>

        <section>
            <div class="container">               
        <div class="row text-center">
            
            <!--Permanent Offers-->
            <div class="col-md-4 mb-4">   
              
                <a href="one-for-one.php" class="card-link text-decoration-none" t>
                    <div class="clickable-card">
                        <img src="offerImages/offer_pic1.jpeg" class="card-img-top" alt="Card image">
                        <div class="offer-card-body">
                            <h5 class="offer-title">1-for-1 Weekday Lunch</h5> 
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4 mb-4">   

                <a href="up-to-twenty-off.php" class="card-link text-decoration-none" t>
                    <div class="clickable-card">
                        <img src="offerImages/offer_pic2.jpeg" class="card-img-top" alt="Card image">
                        <div class="offer-card-body">
                            <h5 class="offer-title">Save Up to 20% on Your Dining</h5> 
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4 mb-4">   

                <a href="dbs_posb_offer.php" class="card-link text-decoration-none" t>
                    <div class="clickable-card">
                        <img src="offerImages/offer_pic.jpeg" class="card-img-top" alt="Card image">
                        <div class="offer-card-body">
                            <h5 class="offer-title">10% DBS/POSB Card Holders</h5> 
                        </div>
                    </div>
                </a>
            </div>
            <!--Permanent Offers End-->
            
            
            <!--Limited Time Offers-->
            <?php
                while($row= mysqli_fetch_array($result)){
            ?>
            
            <div class="col-md-4 mb-4">   

                <a href="offerInfo.php?id=<?= $row['id']?>" class="card-link text-decoration-none" t>
                    <div class="clickable-card">
                        <img src="<?= $row['offer_image'] ?>" class="card-img-top" alt="Card image">
                        <div class="offer-card-body">
                    <h5 class="offer-title"><?= $row['offer_name']?></h5> 
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
            <!--Limited Time Offers End-->
            
            
        </div>
            </div>
        </section>
        
     
        
        <!--End Hero Selection-->

        <?php include ('footer.html');?>
        
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
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
    </script>
</body>
</html>