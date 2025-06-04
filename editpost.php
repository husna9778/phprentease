


<?php 
// Start session
if (!isset($_SESSION)) {
    session_start();
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    // Display the data of the selected row
    $query = "SELECT * FROM adrs WHERE car_id='$car_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Update the data
    if (isset($_POST['btnSubmit'])) {
        $newfirstname = htmlspecialchars($_POST["firstname"]);
        $newlastname = htmlspecialchars($_POST["lastname"]);
        $newstreetaddress = htmlspecialchars($_POST["streetaddress"]);
        $newcity = htmlspecialchars($_POST["city"]);
        $newphonenumber = htmlspecialchars($_POST["phonenumber"]);
        $newdistrict = htmlspecialchars($_POST["district"]);
        $newpincode = htmlspecialchars($_POST["pincode"]);
        $neworderdate = htmlspecialchars($_POST["orderdate"]);
        $query = "UPDATE adrs SET firstname='$newfirstname', lastname='$newlastname', streetaddress='$newstreetaddress', city='$newcity', phonenumber='$newphonenumber', district='$newdistrict', pincode='$newpincode', orderdate='$neworderdate' WHERE car_id='$car_id'";
        mysqli_query($con, $query);
        header("Location: managepost.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <h2>Edit Post</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $row['firstname']; ?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $row['lastname']; ?>">
            </div>
            <div class="mb-3">
                <label for="streetaddress" class="form-label">Street Address</label>
                <textarea name="streetaddress" id="streetaddress" class="form-control"><?php echo $row['streetaddress']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control" value="<?php echo $row['city']; ?>">
                <div class="mb-3">
    <label for="district" class="form-label">District</label>
    <select name="district" id="district" class="form-control">
        <option value="">Select District</option>
        <option value="Alappuzha" <?php if($row['district'] == 'Alappuzha') echo 'selected'; ?>>Alappuzha</option>
        <option value="Ernakulam" <?php if($row['district'] == 'Ernakulam') echo 'selected'; ?>>Ernakulam</option>
        <option value="Idukki" <?php if($row['district'] == 'Idukki') echo 'selected'; ?>>Idukki</option>
        <option value="Kannur" <?php if($row['district'] == 'Kannur') echo 'selected'; ?>>Kannur</option>
        <option value="Kasaragod" <?php if($row['district'] == 'Kasaragod') echo 'selected'; ?>>Kasaragod</option>
        <option value="Kollam" <?php if($row['district'] == 'Kollam') echo 'selected'; ?>>Kollam</option>
        <option value="Kottayam" <?php if($row['district'] == 'Kottayam') echo 'selected'; ?>>Kottayam</option>
        <option value="Kozhikode" <?php if($row['district'] == 'Kozhikode') echo 'selected'; ?>>Kozhikode</option>
        <option value="Malappuram" <?php if($row['district'] == 'Malappuram') echo 'selected'; ?>>Malappuram</option>
        <option value="Palakkad" <?php if($row['district'] == 'Palakkad') echo 'selected'; ?>>Palakkad</option>
        <option value="Pathanamthitta" <?php if($row['district'] == 'Pathanamthitta') echo 'selected'; ?>>Pathanamthitta</option>
        <option value="Thiruvananthapuram" <?php if($row['district'] == 'Thiruvananthapuram') echo 'selected'; ?>>Thiruvananthapuram</option>
        <option value="Thrissur" <?php if($row['district'] == 'Thrissur') echo 'selected'; ?>>Thrissur</option>
        <option value="Wayanad" <?php if($row['district'] == 'Wayanad') echo 'selected'; ?>>Wayanad</option>
    </select>
</div>
</div>
<div class="mb-3">
<label for="pincode" class="form-label">Pincode</label>
<input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo $row['pincode']; ?>">
</div>
<div class="mb-3">
<label for="phonenumber" class="form-label">Phone Number</label>
<input type="text" name="phonenumber" id="phonenumber" class="form-control" value="<?php echo $row['phonenumber']; ?>">
</div>
<div class="mb-3">
<label for="orderdate" class="form-label">Order Date</label>
<input type="date" name="orderdate" id="orderdate" class="form-control" value="<?php echo $row['orderdate']; ?>">
</div>
<input type="submit" name="btnSubmit" value="Update" class="btn btn-primary">
</form>
</div>
</body>
</html>

