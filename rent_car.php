<?php 
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

if (isset($_POST['car_id'])) {
  $car_id = $_POST['car_id'];
  $payment_plan = $_POST['paymentplan'];

  // Update car status to rented
  $query = "UPDATE carss SET status = 'rented' WHERE id = '$car_id'";
  mysqli_query($con, $query) or die(mysqli_error($con));

  // Redirect to the same page
  header("Location: index.php");
}
?>