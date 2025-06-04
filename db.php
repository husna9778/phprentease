
<?php
$conn = mysqli_connect("localhost", "root", "", "rentease");


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function getTotalCars() {
  global $conn;
  $sql = "SELECT COUNT(*) as total FROM cars";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total'];
}


function getTotalCustomers() {
  global $conn;
  $sql = "SELECT COUNT(*) as total FROM users";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total'];
}
?>


