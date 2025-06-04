<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Car Club Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Russo One', sans-serif;
            color: white;
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #f5c518;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #e10600;
            color: white;
            border: none;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #b10000;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
            color: #f5c518;
        }
        .register-link a {
            color: #f5c518;
            text-decoration: underline;
            font-weight: 600;
        }
        .register-link a:hover {
            color: #e10600;
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container col-md-4 login-container">
        <h2>Login to Car Club</h2>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['login_error'] . "</div>";
            unset($_SESSION['login_error']);
        }
        ?>
        <form method="post" action="authenticate.php">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
        <div class="register-link">
            Don't have an account? <a href="signup.php">Sign up here</a>
        </div>
    </div>
</body>
</html>
