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

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM offer WHERE id='$id'";
    $result= mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result);
}else{
    echo'No Offers Found';
}

?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Info</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="offerCSS.css" rel="stylesheet">
       
    </head>
    <body style="background-color: #000">
        
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
                        <a class="nav-link active mx-lg-2" href="offers.php" >Offers</a>
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
          <main>
    <section class="offer-info-hero mt-5">
      <div class="container">
        <div class="row">
            
          <div class="col-md-6">
            <img src="<?= $row['offer_image'] ?>" class="img-fluid" alt="Offer Picture"> 
          </div>
            
          <div class="col-md-6 text-content text-white">  
            <h1><?= $row['offer_name']?></h1>
            <p><?= $row['offer_desc']?></p>
            <p><?= $row['offer_desc2']?></p>
            <p><span style="font-weight: bold">Offer Period: </span><span><?= $row['offer_period']?></span></p><br>
            
            <div>
                <a href="#demo" data-bs-toggle="collapse" class="terms-link">
                    Terms and Conditions 
                    <i class="arrow down" id="termsArrow"></i> 
                </a>
                <div id="demo" class="collapse">
                    <div class="custom-content">
                        <ul>
                            <li>All prices are in SGD and subject to 10% service charge and prevailing government taxes</li>
                            <li>Offer cannot be combined with other offers, promotions, or discounts.</li>
                            <li>Blackout dates may apply.</li>
                            <li>For enquiries, please call (+65) xxxxxxxx or email
                        <a href="mailto:#">xxxxxxxx@yyyy.com</a>.</li>
                        </ul>
                    </div>
                </div>
            </div><br>

            <script>
                const termsLink = document.querySelector('.terms-link');
                const termsArrow = document.getElementById('termsArrow');

                termsLink.addEventListener('click', function() {
                termsArrow.classList.toggle('down');
                termsArrow.classList.toggle('up');
                });
            </script>

            <div class="mt-3">
              <a href="menu.php" class="btn btn-warning" >View Menu</a>
              <a href="reservation.php" class="btn btn-outline-warning">Reserve Now</a>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </main>
        
        <?php
        include 'footer.html'
        ?>
        
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
