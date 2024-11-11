<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Check for session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['expire_time'])) {
    // Last request was more than 10 minutes ago
    session_unset(); // Unset $_SESSION variable for the runtime
    session_destroy(); // Destroy session data in storage
    header("Location: admin_login.php");
    exit();
}

$_SESSION['last_activity'] = time();
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

// Handle deletion of offer
if (isset($_GET['delete_offer_id'])) {
    $delete_id = $_GET['delete_offer_id'];
    $delete_sql = "DELETE FROM offer WHERE id = $delete_id";
    $conn->query($delete_sql);
}

// Fetch current offers
$offer_sql = "SELECT * FROM offer";
$offer_result = $conn->query($offer_sql);

// Handle add offer
$msg = '';
if (isset($_POST['submit'])) {
    $offerName = $_POST['offerName'];
    $offerDesc1 = $_POST['offerDesc1'];
    $offerDesc2 = $_POST['offerDesc2'];
    $offerPeriod = $_POST['offerPeriod'];

    $target_dir = "offerImages/";
    $target_file = $target_dir . basename($_FILES['offerImg']['name']); 

    $check = getimagesize($_FILES["offerImg"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['offerImg']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO offer (offer_name, offer_desc, offer_image, offer_desc2, offer_period) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $offerName, $offerDesc1, $target_file, $offerDesc2, $offerPeriod); 

            if (mysqli_stmt_execute($stmt)) {
                $msg = "Offer Added To The Database Successfully!";
            } else {
                $msg = "Failed to add offer to the database.";
            }

            mysqli_stmt_close($stmt); 
        } else {
            $msg = "Sorry, there was an error uploading your file.";
        }
    } else {
       $msg = "File is not an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Offers</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            color: black;
        }
        .table-container {
            margin-top: 30px;
        }
        
    </style>
    <link href="admin_style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin.php">View Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_users.php">View Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="past_reservations.php">Past Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_subscribers.php">View Subscribers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="offer.php">Manage Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cv.php">View CVs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_contact_messages.php">View Contact Messages</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container admin-container mt-5">
        <h2 class="mb-4">Add New Offer</h2>
        <div class="form-container">
            <form action="offer.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" name="offerName" class="form-control" placeholder="Offer Name" required>
                </div>
                <div class="mb-3">
                    <textarea name="offerDesc1" class="form-control" placeholder="Offer Description 1st Paragraph" required></textarea>
                </div>
                <div class="mb-3">
                    <textarea name="offerDesc2" class="form-control" placeholder="Offer Description 2nd Paragraph" required></textarea>
                </div>
                <div class="mb-3">
                    <input type="text" name="offerPeriod" class="form-control" placeholder="Offer Period" required>
                </div>
                <div class="mb-3">
                    Offer Image:
                    <input type="file" name="offerImg" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit" class="btn btn-success w-100" value="Add Offer">
                </div>
                <?php if ($msg != ''): ?>
                    <div class="form-group">
                        <h5 class="text-center"><?php echo $msg; ?></h5>
                    </div>
                <?php endif; ?>
            </form>
        </div>

        <h2 id="view-offers" class="mt-5 mb-4">Current Offers</h2>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Offer Name</th>
                            <th>Offer Description</th>
                            <th>Offer Image</th>
                            <th>Offer Period</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($offer_result->num_rows > 0) {
                            while ($row = $offer_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['offer_name'] . "</td>";
                                echo "<td>" . $row['offer_desc'] . "</td>";
                                echo "<td><img src='" . $row['offer_image'] . "' alt='Offer Image' style='width: 100px; height: auto;'></td>";
                                echo "<td>" . $row['offer_period'] . "</td>";
                                echo "<td><a href='offer.php?delete_offer_id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No offers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
