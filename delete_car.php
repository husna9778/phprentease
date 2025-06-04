<?php 
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Delete car from database
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM carss WHERE id='$id'";
    if (mysqli_query($con, $query)) {
        header("Location: manage_suzuki.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid request";
}
?>


