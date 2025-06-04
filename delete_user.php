<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: adminlogin.php');
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "rentease");

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id = '$id'";
mysqli_query($conn, $query);

header('Location: admin_dashboard.php');
exit;
?>