<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Car Club Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Russo One', sans-serif;
            color: white;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f5c518;
        }
        .btn-primary {
            background-color: #e10600;
            border: none;
        }
        .btn-primary:hover {
            background-color: #b10000;
        }
        .alert {
            font-weight: bold;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container col-md-6 form-container">
        <h2>Join the Car Club</h2>
        <?php
        if (isset($_SESSION['signup_error'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['signup_error'] . "</div>";
            unset($_SESSION['signup_error']);
        }
        ?>
        <form action="send_otp.php" method="post">
            <input class="form-control mb-3" type="text" name="fullname" placeholder="Full Name" required>
            <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
            <input class="form-control mb-3" type="password" name="repeat_password" placeholder="Repeat Password" required>
            <button class="btn btn-primary w-100" type="submit">Register & Get OTP</button>
        </form>
    </div>
</body>
</html>
