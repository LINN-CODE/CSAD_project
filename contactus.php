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

$msg = ''; // Initialize the variable

if (isset($_POST['submit'])) {
    // Sanitize input data
    $Name = htmlspecialchars(strip_tags($_POST['name']));
    $Email = htmlspecialchars(strip_tags($_POST['email']));
    $Contact = htmlspecialchars(strip_tags($_POST['contact']));
    $Message = htmlspecialchars(strip_tags($_POST['message']));

    $sql = "INSERT INTO contactus(name, email, number, message) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $Name, $Email, $Contact, $Message);

    if (mysqli_stmt_execute($stmt)) {
        $msg = "Submitted Successfully!";
    } else {
        $msg = "Failed to Submit.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="contact.css" rel="stylesheet">
</head>
<body style="background-color: #333">

    <!--Navbar-->
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
                            <a class="nav-link mx-lg-2" aria-curre t="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="menu.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="offers.php">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active mx-lg-2" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="join_us.php">Join us</a>
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

    <section class="contact-section">
        <div class="container">
            <div class="contact-content text-center text-white">
                <h1 class="contact-title" style="font-weight: bold">Contact Us</h1>
                <p class="contact-description">
                    Get in touch with us. Whether you have enquiries about your reservations, event bookings,
                    or just to share your feedback on your dining experience with us, our team is here to assist you.
                </p>
            </div>
        </div>
    </section>

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

    <section class="contact-mid-section p-4 mt-4">
        <div class="container">
            <div class="row text-white">
                <div class="col-md-3 text-center">
                    <i class="bi bi-geo-alt"></i>
                    <p>xxxxxxxxxxx, Singapore xxxxxx</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="bi bi-telephone"></i>
                    <p>+65 xxxx xxxx</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="bi bi-envelope"></i>
                    <p>xxxxxxxx@yyyy.com</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="bi bi-instagram"></i>
                    <p>@xxxxxx</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid mt-5 p-5">
        <div class="row text-center text-white">
            <div class="col-12 col-xl-6 space-top-l">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.805248882749!2d103.77430801108212!3d1.309952462094208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1a3b39ac5531%3A0x4358db43064c4c8e!2sSingapore%20Polytechnic!5e0!3m2!1sen!2ssg!4v1713101162663!5m2!1sen!2ssg" width="90%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-12 col-xl-6 space-top-2 ml-4">
                <form method="POST" action="">
                    <div class="mb-4 row">
                        <label for="input-name" class="col-sm-3 col-form-label white-font flex-align-center" style="font-weight: bold">Name *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control thick-input" required="" name="name">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="input-email" class="col-sm-3 col-form-label white-font flex-align-center" style="font-weight: bold">Email Address *</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control thick-input" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" oninvalid="this.setCustomValidity('Invalid Email Address')" onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')" required="" name="email">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="input-contact" class="col-sm-3 col-form-label white-font flex-align-center" style="font-weight: bold">Contact No. *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control thick-input" required="" name="contact" pattern="[+ 0-9]+" title="Only numbers (0-9) and (+) are allowed">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="input-email" class="col-sm-3 col-form-label white-font flex-align-start" style="font-weight: bold;">Message *</label>
                        <div class="col-sm-9">
                            <textarea class="form-control thick-input" required="" name="message" rows="5" placeholder="How can we assist you today" style="resize:none"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-danger w-50" value="Submit">
                    </div><br>
                    <h5><?= $msg ?></h5>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.getElementById('profile-button');
            profileButton.addEventListener('click', function () {
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

        document.getElementById('subscribeForm').addEventListener('submit', function (event) {
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
