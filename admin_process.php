<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hardcoded credentials
    $admin_username = "admin";
    $admin_password = "doverpoly";

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['last_activity'] = time(); // Set the session timeout
        $_SESSION['expire_time'] = 600; // 10mins (600 seconds)
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: admin_login.php");
        exit();
    }
}
?>
