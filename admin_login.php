<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 400px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
        }

        .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }

        .text-center a {
            color: #6a11cb;
            text-decoration: none;
        }

        .text-center a:hover {
            color: #2575fc;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Admin Login</h3>
        <form action="admin_process.php" method="post">
            <input type="text" id="username" name="username" class="form-control mb-3" placeholder="admin" required>
            <input type="password" id="password" name="password" class="form-control mb-3" placeholder="doverpoly" required>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <?php if (isset($_SESSION['login_error'])): ?>
        <script>
            alert("<?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>");
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
