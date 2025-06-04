<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carType = $_POST['car_type'];
    $pickup = $_POST['pickup_location'];
    $drop = $_POST['drop_location'];
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];

    // Sample processing logic (e.g., save to a database)
    echo "<h2>Reservation Confirmed</h2>";
    echo "Car Type: $carType <br>";
    echo "From: $pickup to $drop <br>";
    echo "Dates: $from to $to";
} else {
    echo "Invalid request.";
}
?>
