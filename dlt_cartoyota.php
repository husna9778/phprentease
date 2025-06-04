<?php 
// Database connection 
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error'); 

// Delete car from database 
$id = $_GET['id']; 
$query = "DELETE FROM carsss WHERE id='$id'";
mysqli_query($con, $query);
header("Location: manage_toyota.php");
exit;
?>