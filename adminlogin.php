<?php
session_start();

// Hardcoded admin credentials (for demonstration)
$adminEmail = "husnakk85@gmail.com";
$adminPassword = "admin";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: adminhome.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background: #2c3e50;
            font-family: Arial, sans-serif;
        }

        .login-form {
            width: 300px;
            margin: 100px auto;
            background: #ecf0f1;
            padding: 30px;
            border-radius: 8px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        input[type="submit"] {
            background: #2980b9;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <form class="login-form" method="POST" action="">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="email" name="email" placeholder="Email ID" required>
        <input type="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" name="remember"> Remember me</label><br><br>
        <input type="submit" value="LOGIN">
    </form>
</body>

</html>

