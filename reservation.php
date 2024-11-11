<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "group_project";

$conn = new mysqli($servername, $username, $password, $dbname);

$date_filter = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d', strtotime('+5 days'));
$sql = "SELECT * FROM time_slots WHERE is_available = 1 AND date = '$date_filter' ORDER BY meal_period, time";
$available_slots = $conn->query($sql);
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
        
    <style>
        
        input[type="date"] {
            padding: 10px; /* Increase padding */
            outline: none;
        }
        
        .btn{
            background-color: #ffcc00; 
            border-color: #ffcc00;
        } 
        
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

        .btn:hover{
            opacity: 0.7;
            border-color: #ffcc00;
            background-color: #ffcc00; 
        }
      
        .modal-content {
            background-color: #f8f9fa;
            border-radius: 0.3rem;
        }

        .time-slot {
            cursor: pointer;
            padding: 10px;
            border: 1px solid #ccc;
            margin: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
            flex: 1 0 30%;
        }

        .time-slot:hover {
            background-color: #e6e6e6;
        }

        .time-slot.active {
            background-color: #ffcc00;
            border-color: #ffcc00;
        }
        
        /* Make textarea non-resizable */
        textarea {
            resize: none;
        }

        .modal-body .container {
            padding: 20px;
        }

        .modal-header, .modal-footer {
            border: none;
        }

        .time-slot-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px;
        }

        .time-slot-group {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .time-slot-group strong {
            display: block;
            margin-bottom: 10px;
        }

        .time-slot-group .time-slot {
            margin: 5px;
        }
        
    </style>
</head>
<body>
    <!-- Bootstrap JS-->
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
                            <a class="nav-link mx-lg-2" aria-current="page" href="./index.php">Home</a>
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
                            <a class="nav-link mx-lg-2 active" href="./reservation.php">Reservation</a>
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
    
    <!--Reservation Section-->
    <section class="hero-section"">
        <div class=" d-flex align-items-center justify-content-center text-white flex-column>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="margin-top: 100px;background-color: rgba(0, 0, 0, 0.6);color: white">
                        <div class="card-header text-center">
                            <h3>Reservation</h3>
                        </div>
                        <div class="card-body align-items-center justify-content-center"">
                            <form action="create_checkout_session.php" method="post" id="reservation-form" onsubmit="return validateForm()"> 
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="guests" class="form-label">Guests</label>
                                    <input type="number" id="guests" name="guests" class="form-control" value="2" required readonly data-bs-toggle="modal" data-bs-target="#guestModal">
                                </div>
                                <div class="mb-3">
                                    <label for="time" class="form-label">Time</label>
                                    <input type="text" id="time" name="time" class="form-control" required readonly data-bs-toggle="modal" data-bs-target="#timeModal"> 
                                </div>
                                <div class="mb-3">
                                    <label for="service" class="form-label">Notes</label>
                                    <textarea type="text" id="notes" name="notes" class="form-control" rows="3" required style="resize:none"></textarea>
                                </div>
                                
                                <input type="hidden" id="adultsInput" name="adults" value="2">
                                <input type="hidden" id="childrenInput" name="children" value="0">
                                <input type="hidden" id="babiesInput" name="babies" value="0">
                                <input type="hidden" id="mealPeriodInput" name="meal_period" value="">
                                
                                <button type="submit" class="btn btn-primary w-100">Pay $5 Deposit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Reservation Section-->
    
    <!-- Highlight: Added Guest Modal -->
    <div class="modal fade" id="guestModal" tabindex="-1" aria-labelledby="guestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guestModalLabel">Guests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="adults" class="form-label">Adults</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateGuestCount('adults', -1)">-</button>
                            <input type="number" id="adults" class="form-control" value="2" min="0">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateGuestCount('adults', 1)">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="children" class="form-label">Children</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateGuestCount('children', -1)">-</button>
                            <input type="number" id="children" class="form-control" value="0" min="0">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateGuestCount('children', 1)">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="babies" class="form-label">Babies</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateGuestCount('babies', -1)">-</button>
                            <input type="number" id="babies" class="form-control" value="0" min="0">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateGuestCount('babies', 1)">+</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmGuests()">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Time Modal -->
    <div class="modal fade" id="timeModal" tabindex="-1" aria-labelledby="timeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeModalLabel">Select Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center"><strong>Breakfast</strong></div>
                            <div class="col-4 time-slot" onclick="selectTime('6:00 am', 'breakfast')">6:00 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('6:30 am', 'breakfast')">6:30 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('7:00 am', 'breakfast')">7:00 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('7:30 am', 'breakfast')">7:30 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('8:00 am', 'breakfast')">8:00 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('8:30 am', 'breakfast')">8:30 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('9:00 am', 'breakfast')">9:00 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('9:00 am', 'breakfast')">9:00 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('9:30 am', 'breakfast')">9:30 am</div>
                            <div class="col-4 time-slot" onclick="selectTime('10:00 am', 'breakfast')">10:00 am</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-center"><strong>Lunch</strong></div>
                            <div class="col-4 time-slot" onclick="selectTime('12:00 pm', 'lunch')">12:00 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('12:30 pm', 'lunch')">12:30 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('1:00 pm', 'lunch')">1:00 pm</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-center"><strong>Dinner</strong></div>
                            <div class="col-4 time-slot" onclick="selectTime('6:00 pm', 'dinner')">6:00 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('6:30 pm', 'dinner')">6:30 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('7:00 pm', 'dinner')">7:00 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('7:30 pm', 'dinner')">7:30 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('8:00 pm', 'dinner')">8:00 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('8:30 pm', 'dinner')">8:30 pm</div>
                            <div class="col-4 time-slot" onclick="selectTime('9:00 pm', 'dinner')">9:00 pm</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    
    <script>
           function validateForm() {
        const notes = document.getElementById('notes').value;
        const regex = /<(.|\n)*?>/g;

        if (regex.test(notes)) {
            alert('HTML content is not allowed in the notes.');
            return false;
        }

        return true;
    }
        document.addEventListener('DOMContentLoaded', (event) => {
            const dateInput = document.getElementById('date');
            const today = new Date();
            const minDate = new Date();
            const maxDate = new Date();
            minDate.setDate(today.getDate() + 5); // Set minimum date to 5 days from today
            maxDate.setDate(today.getDate() + 65); // Set maximum date to 65 days from today

            const formatDate = (date) => {
                let day = date.getDate();
                let month = date.getMonth() + 1; // Months are zero-based
                let year = date.getFullYear();

                if (day < 10) day = '0' + day;
                if (month < 10) month = '0' + month;

                return year + '-' + month + '-' + day;
            };

            dateInput.min = formatDate(minDate);
            dateInput.max = formatDate(maxDate);
        });

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
        const stripe = Stripe('sk_test_51PhzGzKbQO3LK6GrCf3r4wPKjIbESQFTJaYUKympJtxf5COSMqFpaFfjOW2xTdgYlUs9x0W1rwYKciei35IzaDsf00Z5GJOMKj');
        const paymentButton = document.getElementById('payment-button');
        const reserveButton = document.getElementById('reserve-button');
        const reservationForm = document.getElementById('reservation-form');

        paymentButton.addEventListener('click', async () => {
            const response = await fetch('create_payment_intent.php', { method: 'POST' });
            const { clientSecret } = await response.json();

            const { error } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: { token: 'tok_visa' }, // Replace with actual card details
                }
            });

            if (error) {
                console.error(error);
                alert('Payment failed');
            } else {
                alert('Payment successful');
                reserveButton.disabled = false;
                reservationForm.submit();
            }
        });

        reservationForm.addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Please complete the payment to confirm your reservation.');
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
       
    
     function updateGuestCount(type, change) {
            const input = document.getElementById(type);
            let currentValue = parseInt(input.value);
            currentValue += change;
            if (currentValue < 0) {
                currentValue = 0;
            }
            input.value = currentValue;
        }

    function confirmGuests() {
        const adults = parseInt(document.getElementById('adults').value);
        const children = parseInt(document.getElementById('children').value);
        const babies = parseInt(document.getElementById('babies').value);
        const totalGuests = adults + children + babies;
        document.getElementById('guests').value = totalGuests;
        document.getElementById('adultsInput').value = adults; // Update hidden field for adults
        document.getElementById('childrenInput').value = children; // Update hidden field for children
        document.getElementById('babiesInput').value = babies; // Update hidden field for babies
        console.log('Confirmed Guests:', { adults, children, babies, totalGuests }); // Debugging line
        const guestModal = bootstrap.Modal.getInstance(document.getElementById('guestModal'));
        guestModal.hide();
    }
    
    function selectTime(time, mealPeriod) {
        document.getElementById('time').value = time;
        document.getElementById('mealPeriodInput').value = mealPeriod;
        const timeSlots = document.getElementsByClassName('time-slot');
        for (let slot of timeSlots) {
            slot.classList.remove('active');
            if (slot.innerText === time) {
                slot.classList.add('active');
            }
        }
        const timeModal = bootstrap.Modal.getInstance(document.getElementById('timeModal'));
        timeModal.hide();
    }
    </script>

</body>
</html>
