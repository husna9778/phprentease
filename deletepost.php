
<?php
// Start session
if (!isset($_SESSION)) {
  session_start();
}

// Database connection
$con = new mysqli("localhost", "root", "", "rentease");

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['car_id']) && is_numeric($_GET['car_id'])) {
  $car_id = $_GET['car_id'];

  // Prepare and bind
  $stmt = $con->prepare("DELETE FROM adrs WHERE car_id = ?");
  if (!$stmt) {
    die("Prepare failed: " . $con->error);
  }
  $stmt->bind_param("i", $car_id);

  // Execute the query
  if ($stmt->execute()) {
    header("Location: managepost.php");
    exit;
  } else {
    echo "Error deleting record: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Invalid car ID.";
}

$con->close();
?>


This modified version checks for errors when connecting to the database and preparing the statement, and it also checks if the "car_id" is numeric before attempting to delete the record.