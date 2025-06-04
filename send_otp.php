<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'database.php';
require 'vendor/autoload.php'; // Or include PHPMailer classes manually

session_start();

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

if (empty($fullname) || empty($email) || empty($password) || empty($repeat_password)) {
    $_SESSION['signup_error'] = "All fields are required.";
    header("Location: signup.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['signup_error'] = "Invalid email format.";
    header("Location: signup.php");
    exit;
}

if ($password !== $repeat_password) {
    $_SESSION['signup_error'] = "Passwords do not match.";
    header("Location: signup.php");
    exit;
}

if (strlen($password) < 8) {
    $_SESSION['signup_error'] = "Password must be at least 8 characters.";
    header("Location: signup.php");
    exit;
}

// Check if user already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $_SESSION['signup_error'] = "Email already registered.";
    header("Location: signup.php");
    exit;
}
$stmt->close();

// Generate and email OTP
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['temp_user'] = [
    'fullname' => $fullname,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
$_SESSION['otp_time'] = time();

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'husnakk85@gmail.com'; // Your Gmail
    $mail->Password = 'oowz dyui wfzx widv'; // Use Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('husnakk85@gmail.com', 'My App');
    $mail->addAddress($email, $fullname);

    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body = "<h2>Your OTP is: $otp</h2><p>It expires in 5 minutes.</p>";

    $mail->send();
    header("Location: verify_otp.php");
} catch (Exception $e) {
    $_SESSION['signup_error'] = "Could not send OTP. Mailer Error: {$mail->ErrorInfo}";
    header("Location: signup.php");
}
