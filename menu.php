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
    <link href="menu.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
    /* Custom CSS for overlay */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.5s ease;
    }
    .overlay-content {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      width: 100%;
      height: 80%;
      text-align: center;
    }
    .overlay.show {
      display: flex;
      opacity: 1;
    }
    
    body.overlay-active {
  overflow: hidden;
}

.overlay-active .background-content {
  pointer-events: none; /* Prevents click events */
  filter: blur(2px); /* Optional: Blurs background content */
}
  </style>
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
                      <a class="nav-link active mx-lg-2" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="offers.php" >Offers</a>
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

        <!-- food section -->
        <section class="menu_section">
            <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
                <h1>Uniquely crafted with passion and traditional</h1>
            </div>
        </section>
        
        <section style="background-color: #333">
            <div class="container" >
        <div class="row text-center">
      
        <div class="col-md-3 mb-4">
          <div class="card menu-item">
              <div class="image-container">
          <img src="offerImages/tea_leaf_salad.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
              <p class="overlay-text">Burmese Tea Leaf Salad, or "Lahpet Thoke," is a tangy, crunchy salad made from fermented tea leaves, mixed with nuts, seeds, and vegetables, offering a unique combination of flavors and textures.</p>
          </div>
           
        </div>
              <div class="card-body">
            <h5 id="trigger-text" class="card-title" style="cursor: pointer;">Lahpet Thoke</h5>
          </div>
              
          </div>
        
        </div> <!<!-- End of menu item 1 -->
      
        <div class="col-md-3 mb-4">
        <div class="card menu-item">
          <div class="image-container">
          <img src="offerImages/mohinga.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
            <p class="overlay-text">Mohinga is a traditional Burmese dish featuring rice noodles in a fragrant fish broth, often garnished with crispy fritters and boiled eggs.</p>
          </div>
        </div>
            <div class="card-body">
            <h5 class="card-title">Mohinga</h5>
          </div>
        </div>
      </div>
      
        <div class="col-md-3 mb-4">
        <div class="card menu-item">
          <div class="image-container">
          <img src="offerImages/nan_g_thote.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
            <p class="overlay-text">Nan Gyi Thoke is a flavorful Burmese noodle salad featuring thick rice noodles tossed in a rich chicken curry sauce, topped with crispy noodles, onions, chili, and lime zest.</p>
          </div>
        </div>
            <div class="card-body">
            <h5 class="card-title">Nan Gyi Thoke</h5>
          </div>
        </div>
      </div>
        
        <div class="col-md-3 mb-4">
         <div class="card menu-item">
          <div class="image-container">
          <img src="offerImages/shan_noodles.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
            <p class="overlay-text">
Shan Noodles features rice noodles served in a flavorful broth with marinated chicken or pork, garnished with herbs and crunchy peanuts.</p>
          </div>
        </div>
             <div class="card-body">
            <h5 class="card-title">Shan Noodles</h5>
          </div>
        </div>
      </div>
        
    </div>
    </div>
        </section>
    
        <!-- drink section -->
        <section class="menu_section2">
            <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
                <h1>Discover the perfect blend</h1>
            </div>
        </section>
        <section style="background-color: #333">
            <div class="container" >
    <div class="row text-center">
      
        <div class="col-md-4 mb-4">
        <div class="card menu-item">
          <div class="image-container">
          <img src="offerImages/tea.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
            <p class="overlay-text"> Locally known as "Lahpet Yay," is a rich and creamy beverage made by brewing strong black tea and mixing it with condensed milk and sugar, creating a sweet and robust flavor</p>
          </div>
        </div>
            <div class="card-body">
            <h5 class="card-title">Milk Tea</h5>
          </div>
        </div>
      </div>
        
        <div class="col-md-4 mb-4">
         <div class="card menu-item">
          <div class="image-container">
          <img src="offerImages/sugar_cane.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
              <p class="overlay-text">
                   A refreshing beverage made from freshly pressed sugar cane. The juice is lightly sweet and often enjoyed chilled, sometimes with a splash of lime or a hint of ginger for added flavor. It's a popular and invigorating choice, especially in hot weather.
              </p>
          </div>
        </div>
             <div class="card-body">
            <h5 class="card-title">Sugar Cane</h5>
          </div>
        </div>
      </div>
      
        <div class="col-md-4 mb-4">
        <div class="card menu-item">
          <div class="image-container">
          <img src="offerImages/shwe_yin_aye.jpg" class="img-fluid" alt="A La Carte">
          <div class="overlay">
            <p class="overlay-text">Known for its creamy and refreshing qualities, Shwe Yin Aye consists of a blend of coconut milk, sweetened condensed milk, and various ingredients such as jelly cubes, sago pearls, and sometimes fruits, and served over crushed ice.</p>
          </div>
        </div>
            <div class="card-body">
            <h5 class="card-title">Shwe Yin Aye</h5>
          </div>
        </div>
      </div>
        
        
        
    </div>
            </div>
        </section>
    
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
    
        document.addEventListener('DOMContentLoaded', (event) => {
          const triggerText = document.getElementById('trigger-text');
          const overlay = document.getElementById('overlay');
          const closeBtn = document.getElementById('close-btn');

          triggerText.addEventListener('click', () => {
            document.body.classList.add('overlay-active');
                  overlay.classList.add('show');
          });

          closeBtn.addEventListener('click', () => {
            document.body.classList.remove('overlay-active');
                  overlay.classList.remove('show');
          });

          overlay.addEventListener('click', () => {
              document.body.classList.remove('overlay-active');
            overlay.classList.remove('show');
          });

          // Prevent overlay-content click from closing the overlay
          overlay.querySelector('.overlay-content').addEventListener('click', (event) => {
            event.stopPropagation();
          });
        });
    </script>
        
        <!--End Hero Selection-->

       
</body>
</html>