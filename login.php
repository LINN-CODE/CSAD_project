<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        
        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px;
        }

        .login-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h3 {
            margin-bottom: 20px;
        }

        .login-right .form-control {
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
            .login-container {
                flex-direction: column;
            }

            .login-left, .login-right {
                flex: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['login_error'])): ?>
        <script>
            alert("<?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>");
        </script>
    <?php endif; ?>
    
    <div class="login-container">
        <div class="login-left">
            <h1>Welcome Back!</h1>
            <p>Please login to your account to continue.</p>
        </div>
        <div class="login-right">
            <h3>Login</h3>
            <form action="login_process.php" method="post">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="mt-3 text-center">New user? <a href="signup.php">Sign up</a></p>
            </form>
        </div>
    </div>

</body>
</html>
