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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $guests = $_POST["guests"];
    $time = $_POST["time"];
    $notes = $_POST["notes"];
    $adults = $_POST["adults"];
    $children = $_POST["children"];
    $babies = $_POST["babies"];
    $meal_period = $_POST["meal_period"];
    
    // Fetch user name and email from session
    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; // Use session data
    $user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'guest@example.com'; // Use session data

    // Insert booking into database with user name and email
    $sql = "INSERT INTO reservation_times (date, time, guests, adults, children, babies, notes, user_name, user_email)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiissss", $date, $time, $guests, $adults, $children, $babies, $notes, $user_name, $user_email);

    if ($stmt->execute()) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
