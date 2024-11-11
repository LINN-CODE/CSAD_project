<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .signup-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .signup-left {
            flex: 1;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px;
        }

        .signup-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-right h3 {
            margin-bottom: 20px;
        }

        .signup-right .form-control {
            margin-bottom: 20px;
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

        @media (max-width: 768px) {
            .signup-container {
                flex-direction: column;
            }

            .signup-left, .signup-right {
                flex: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-left">
            <h1>Welcome!</h1>
            <p>Create your account to get started.</p>
        </div>
        <div class="signup-right">
            <h3>Sign Up</h3>
            <form action="signup_process.php" method="post" onsubmit="return validatePassword()">
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

            if (!regex.test(password)) {
                alert("Password must be at least 8 characters long, include both upper and lowercase letters, contain at least one numeric digit, and contain at least one special character.");
                return false;
            }

            if (password !== confirm_password) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>

    <?php if (isset($_SESSION['signup_error'])): ?>
        <script>
            alert("<?php echo $_SESSION['signup_error']; unset($_SESSION['signup_error']); ?>");
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>
