<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Verify OTP</title></head>
<body>
    <div class="container mt-5">
        <h2>Enter the OTP sent to your email</h2>
        <?php
        if (isset($_SESSION['otp_error'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['otp_error'] . "</div>";
            unset($_SESSION['otp_error']);
        }
        ?>
        <form method="post" action="verify_otp.php">
            <input class="form-control mb-3" type="text" name="otp" required>
            <button class="btn btn-success" type="submit">Verify</button>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['otp']) || !isset($_SESSION['temp_user'])) {
        $_SESSION['otp_error'] = "Session expired.";
        header("Location: signup.php");
        exit;
    }

    $entered_otp = $_POST['otp'];
    if (time() - $_SESSION['otp_time'] > 300) {
        $_SESSION['otp_error'] = "OTP expired.";
        session_destroy();
        header("Location: signup.php");
        exit;
    }

    if ($entered_otp == $_SESSION['otp']) {
        require 'database.php';
        $user = $_SESSION['temp_user'];
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user['fullname'], $user['email'], $user['password']);
        $stmt->execute();
        unset($_SESSION['temp_user']);
        echo "<script>alert('Registration Successful!'); window.location.href = 'login.php';</script>";
    } else {
        $_SESSION['otp_error'] = "Incorrect OTP.";
        header("Location: verify_otp.php");
    }
}
?>
