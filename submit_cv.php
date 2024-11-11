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

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $cv_file = $_FILES['cv']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($cv_file);
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (move_uploaded_file($_FILES['cv']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO cvs (name, email, role, cv_file) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("ssss", $name, $email, $role, $target_file);
        
        if ($stmt->execute()) {
            $msg = "CV submitted successfully!";
        } else {
            $msg = "Failed to submit CV: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    } else {
        $msg = "Sorry, there was an error uploading your file. Error code: " . $_FILES['cv']['error'];
    }
}
$conn->close();

header("Location: cv.php?msg=" . urlencode($msg));
exit();
?>
