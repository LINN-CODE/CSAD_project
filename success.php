<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "group_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['reservation_details'])) {
    $details = $_SESSION['reservation_details'];

    $sql = "INSERT INTO reservation_times (date, time, guests, adults, children, babies, notes, user_name, user_email)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssiiissss", $details['date'], $details['time'], $details['guests'], $details['adults'], $details['children'], $details['babies'], $details['notes'], $details['user_name'], $details['user_email']);

    if ($stmt->execute()) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    unset($_SESSION['reservation_details']);
    
    // Redirect to the index page after successful reservation
    header("Location: index.php");
    exit();
} else {
    echo "No reservation details found.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Stripe Example</title>
    <meta charset="UTF-8" />
</head>
<body>
    <h1>Stripe Example</h1>
    <p>Thank you for your payment!</p>
</body>
</html>
