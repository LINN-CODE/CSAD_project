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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user details
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT * FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

// Get active reservation details
$sql_reservation = "SELECT * FROM reservation_times WHERE user_email = ? AND date >= CURDATE()";
$stmt_reservation = $conn->prepare($sql_reservation);
$stmt_reservation->bind_param("s", $user['email']);
$stmt_reservation->execute();
$result_reservation = $stmt_reservation->get_result();
$reservation = $result_reservation->fetch_assoc();
$stmt_reservation->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .reservation-details {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        @media (max-width: 576px) {
            .profile-container {
                padding: 10px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container profile-container">
        <h2 class="text-center">User Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        
        <?php if ($reservation): ?>
            <div class="reservation-details">
                <h4>Your Active Reservation</h4>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($reservation['date']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($reservation['time']); ?></p>
                <p><strong>Guests:</strong> <?php echo htmlspecialchars($reservation['guests']); ?></p>
                <p><strong>Notes:</strong> <?php echo htmlspecialchars($reservation['notes']); ?></p>
            </div>
        <?php else: ?>
            <p>No active reservations.</p>
        <?php endif; ?>
    </div>
    <script>
        if (window.innerWidth < 576) {
            window.location.href = "user_profile_full.php";
        }
    </script>
</body>
</html>
