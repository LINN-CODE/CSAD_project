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
    <link href="join_us.css" rel="stylesheet">
    
</head>
<body>
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
                      <a class="nav-link  mx-lg-2" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="offers.php" >Offers</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="contactus.php">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active mx-lg-2" href="#" >Join us</a>
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
                             <a href="logout.php" class="btn btn-outline-light " id="logout-button" style="">Logout</a>
                         </div>
                         <?php else: ?>
                         <a href="login.php" class="login-button" id="login_button">Login</a>
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

        <section class="join_section">
            <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
                <h1>Join Our Crew</h1>
            </div>
        </section>
        
    <section class="section1">
        
        <div class="background-image">
            
        <div class="overlay-content">
            <div class="container text-center text-white">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <img src="offerImages/res_crew.jpg" alt="Service Crew" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <div class="card border-20">
                            <div class="card-body">
                                <h1 class="text-warning">Service Crew</h1>
                                <p class="text-white">We're looking for enthusiastic people to join our team! As a Service Crew member, 
                                    you'll be the friendly face of the restaurant, serving customers 
                                    quickly and with a smile. You'll learn about food preparation 
                                    and restaurant cleanliness while being part of a fun and supportive team.</p>
                                <h4 class="text-white">What we're looking for:</h4>
                                <ul>
                                    <li class="text-white">A positive and outgoing personality</li>
                                    <li class="text-white">Strong customer service skills</li>
                                    <li class="text-white">Flexibility to work different shifts, including weekends and holidays</li>
                                </ul>
                                <a href="cv.php">
                                    <button  class="btn btn-danger btn-lg mt-4">Apply Now</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
        <section class="section2">
        
        <div class="background-image">
            
        <div class="overlay-content">
            <div class="container text-center text-white">
                <div class="row align-items-center justify-content-center">
                    
                    <div class="col-md-6">
                        <div class="card border-20">
                            <div class="card-body">
                                <h1 class="text-warning">Barista</h1>
                                <p class="text-white">We are searching for passionate individuals to join our team and create exceptional 
                                    Burmese tea and coffee experiences. Your role will involve brewing delicious coffee, 
                                    preparing delightful deserts, and providing outstanding customer service with a 
                                    friendly smile</p>
                                <h4 class="text-white">What we're looking for:</h4>
                                <ul>
                                    <li class="text-white">Enthusiastic people who love interacting with customers</li>
                                    <li class="text-white">Able to thrive in a fast-paced environment</li>
                                    <li class="text-white">Flexibility to work different shifts, including weekends and holidays</li>
                                </ul>
                                <a href="cv.php">
                                    <button  class="btn btn-danger btn-lg mt-4">Apply Now</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="offerImages/barista.jpg" alt="Service Crew" class="img-fluid rounded" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
        <section class="section3">
        
        <div class="background-image">
            
        <div class="overlay-content">
            <div class="container text-center text-white">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <img src="offerImages/manager.jpg" alt="Service Crew" class="img-fluid rounded" >
                    </div>
                    <div class="col-md-6">
                        <div class="card border-20">
                            <div class="card-body">
                                <h1 class="text-warning">Management</h1>
                                <p class="text-white">We are searching for passionate individuals to join our team and create exceptional 
                                    \coffee experiences. We believe that crafting the perfect cup requires both skill and artistry. 
                                    As a Barista, you'll undergo extensive training to master every aspect of coffee making, 
                                    from bean to cup.Your role will involve brewing delicious coffee, 
                                    preparing delightful pastries, and providing outstanding customer service with a 
                                    friendly smile</p>
                                <h4 class="text-white">What we're looking for:</h4>
                                <ul>
                                    <li class="text-white">A Degree, Diploma, Higher in any discipline</li>
                                    <li class="text-white">Individuals with a strong desire to succeed</li>
                                    <li class="text-white">Flexibility to work different shifts, including weekends and holidays</li>
                                </ul>
                                
                                <a href="cv.php">
                                    <button  class="btn btn-danger btn-lg mt-4">Apply Now</button></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </section>
        <section class="section4">
        
        <div class="background-image">
            
        <div class="overlay-content">
            <div class="container text-center text-white">
                <div class="row align-items-center justify-content-center">
                    
                    <div class="col-md-6">
                        <div class="card border-20">
                            <div class="card-body">
                                <h1 class="text-warning">Delivery</h1>
                                <p class="text-white">We are looking for friendly and reliable individuals to 
                                    join our Delivery team. We believe in bringing joy to our customers, 
                                    not just through our food but also through exceptional delivery service.
                                We offer flexible schedules, comprehensive training, 
                                and opportunities for career growth within a global company.</p>
                                <h4 class="text-white">What we're looking for:</h4>
                                <ul>
                                    <li class="text-white">A valid license with riding experience</li>
                                    <li class="text-white">The ability to serve customers in a fast and friendly manner</li>
                                    <li class="text-white">Flexibility to work different shifts, including weekends and holidays</li>
                                </ul>
                                <a href="cv.php">
                                    <button  class="btn btn-danger btn-lg mt-4">Apply Now</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="offerImages/rider.jpg" alt="Service Crew" class="img-fluid rounded" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
        
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