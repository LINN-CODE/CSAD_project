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
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $role = strip_tags($_POST['role']);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['cv']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual PDF
    if ($fileType != "pdf") {
        $uploadOk = 0;
        $msg = "Sorry, only PDF files are allowed.";
    }

    if ($uploadOk == 0) {
        // File is not a PDF
        $msg = "Sorry, your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO cvs (name, email, role, cv_file) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $role, $target_file);

            if ($stmt->execute()) {
                $msg = "Your CV has been submitted successfully!";
                header("Location: index.php?msg=" . urlencode($msg));
                exit();
            } else {
                $msg = "Sorry, there was an error submitting your CV.";
            }

            $stmt->close();
        } else {
            $msg = "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Submission Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-info mt-5">
                    <?php echo htmlspecialchars($msg); ?>
                </div>
                <a href="index.php" class="btn btn-primary">Return to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
