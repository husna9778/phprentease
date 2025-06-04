<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: adminlogin.php');
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "rentease");

if (isset($_POST['submit'])) {
    $car_name = $_POST['car_name'];
    $price = $_POST['price'];

    $query = "INSERT INTO cars (car_name, price) VALUES ('$car_name', '$price')";
    mysqli_query($conn, $query);

    header('Location: admin_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
</head>
<body>
    <form method="post" action="">
        <label>Car Name:</label>
        <input type="text" name="car_name"><br><br>
        <label>Price:</label>
        <input type="text" name="price"><br><br>
        <input type="submit" name="submit" value="Add Car">
    </form>
</body>
</html>
