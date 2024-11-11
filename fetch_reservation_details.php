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

$response = ['success' => false];

if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    $current_date = date("Y-m-d");
    $sql = "SELECT * FROM reservation_times WHERE user_email = ? AND date >= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_email, $current_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $response['success'] = true;
        $response['reservation'] = $result->fetch_assoc();
    }
    
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
