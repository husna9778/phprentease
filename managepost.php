<?php 
// Start session
if (!isset($_SESSION)) {
    session_start();
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Display list of address with edit and delete options
$query = "SELECT * FROM adrs";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <h2>Manage Users</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Payment Plan</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Street Address</th>
                    <th>City</th>
                    <th>District</th>
                    <th>Pincode</th>
                    <th>Phone Number</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['car_id']; ?></td>
                    <td><?php echo $row['paymentplan']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['streetaddress']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['district']; ?></td>
                    <td><?php echo $row['pincode']; ?></td>
                    <td><?php echo $row['phonenumber']; ?></td>
                    <td><?php echo $row['orderdate']; ?></td>
                    <td>
                        <a href="editpost.php?car_id=<?php echo $row['car_id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="deletepost.php?car_id=<?php echo $row['car_id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

