
<?php 
// Database connection 
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error'); 

// Delete car from database 
$id = $_GET['id']; 
$query = "DELETE FROM carssss WHERE id='$id'";
mysqli_query($con, $query);
header("Location: manage_honda.php");
exit;
?>