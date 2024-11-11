<?php
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
    $email = $_POST["email"];

    // Check if user is registered
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User is registered, insert into subscribers table
        $sql = "INSERT INTO subscribers (email) VALUES (?) ON DUPLICATE KEY UPDATE email=email";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Thank you for subscribing!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Subscription failed. Please try again."]);
        }
    } else {
        // User is not registered
        echo json_encode(["success" => false, "message" => "Please register to subscribe."]);
    }

    $stmt->close();
    $conn->close();
}
?>
