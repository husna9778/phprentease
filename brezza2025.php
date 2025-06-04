<?php
// Start session
if (!isset($_SESSION)) {
    session_start();
}

// Database connection
$con = new mysqli("localhost", "root", "", "rentease");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get car id and payment plan
$car_id = $_POST['car_id'] ?? '';
$paymentplan = $_POST['paymentplan'] ?? '';

// Initialize errors array
$errors = [];

// Check if form is submitted
if (isset($_POST['btnSubmit'])) {
    // Validate required fields
    $required_fields = ["firstname", "lastname", "streetaddress", "city", "district", "pincode", "phonenumber", "orderdate"];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst($field) . " is required.";
        }
    }

    // Validate phone number
    if (strlen($_POST['phonenumber']) != 10 || !ctype_digit($_POST['phonenumber'])) {
        $errors[] = "Invalid phone number. Phone number must be exactly 10 digits.";
    }

    // Validate pincode
    if (!preg_match("/^[0-9]{6}$/", $_POST['pincode'])) {
        $errors[] = "Invalid pincode.";
    }

    if (empty($errors)) {
        // Sanitize inputs
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $streetaddress = htmlspecialchars($_POST["streetaddress"]);
        $city = htmlspecialchars($_POST["city"]);
        $phonenumber = htmlspecialchars($_POST["phonenumber"]);
        $district = htmlspecialchars($_POST["district"]);
        $pincode = htmlspecialchars($_POST["pincode"]);
        $orderdate = htmlspecialchars($_POST["orderdate"]);

        // Insert data into adrs table
        $stmt = $con->prepare("INSERT INTO adrs (car_id, paymentplan, firstname, lastname, streetaddress, city, phonenumber, district, pincode, orderdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $car_id, $paymentplan, $firstname, $lastname, $streetaddress, $city, $phonenumber, $district, $pincode, $orderdate);
        
        if ($stmt->execute()) {
            // Update car status to 'rented'
            $update = $con->prepare("UPDATE carss SET status = 'rented' WHERE id = ?");
            $update->bind_param("i", $car_id);
            $update->execute();

            // Redirect to confirmation
            header("Location: confirmation.php");
            exit;
        } else {
            echo "<p style='color: red;'>Error inserting data: " . $stmt->error . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="brezza2025.css">
</head>
<body>
<script>
    function validatePhoneNumber() {
        var phoneNumber = document.getElementById("phonenumber").value;
        if (phoneNumber.length != 10 || isNaN(phoneNumber)) {
            alert("Phone number must be exactly 10 digits.");
            return false;
        }
        return true;
    }
</script>

<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id); ?>">
        <input type="hidden" name="paymentplan" value="<?php echo htmlspecialchars($paymentplan); ?>">
        <div class="card w-50">
            <div class="card-header">
                <h1 class="card-title">Address Form</h1>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="streetaddress" class="form-label">Street Address</label>
                    <textarea name="streetaddress" id="streetaddress" class="form-control" rows="4" cols="50" placeholder="Enter Street Address"><?php echo isset($_POST['streetaddress']) ? htmlspecialchars($_POST['streetaddress']) : ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="phonenumber" class="form-label">Phone No</label>
                    <input type="tel" name="phonenumber" id="phonenumber" class="form-control" placeholder="Enter Phone Number" value="<?php echo isset($_POST['phonenumber']) ? htmlspecialchars($_POST['phonenumber']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="Enter City" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <select name="district" id="district" class="form-control">
                        <option value="">Select District</option>
                        <option value="Alappuzha" <?php if (isset($_POST['district']) && $_POST['district'] === 'Alappuzha') echo 'selected'; ?>>Alappuzha</option>
                        <option value="Ernakulam" <?php if (isset($_POST['district']) && $_POST['district'] === 'Ernakulam') echo 'selected'; ?>>Ernakulam</option>
                        <option value="Idukki" <?php if (isset($_POST['district']) && $_POST['district'] === 'Idukki') echo 'selected'; ?>>Idukki</option>
                        <option value="Kannur" <?php if (isset($_POST['district']) && $_POST['district'] === 'Kannur') echo 'selected'; ?>>Kannur</option>
                        <option value="Kasaragod" <?php if (isset($_POST['district']) && $_POST['district'] === 'Kasaragod') echo 'selected'; ?>>Kasaragod</option>
                        <option value="Kollam" <?php if (isset($_POST['district']) && $_POST['district'] === 'Kollam') echo 'selected'; ?>>Kollam</option>
                        <option value="Kottayam" <?php if (isset($_POST['district']) && $_POST['district'] === 'Kottayam') echo 'selected'; ?>>Kottayam</option>
                        <option value="Kozhikode" <?php if (isset($_POST['district']) && $_POST['district'] === 'Kozhikode') echo 'selected'; ?>>Kozhikode</option>
                        <option value="Malappuram" <?php if (isset($_POST['district']) && $_POST['district'] === 'Malappuram') echo 'selected'; ?>>Malappuram</option>
                        <option value="Palakkad" <?php if (isset($_POST['district']) && $_POST['district'] === 'Palakkad') echo 'selected'; ?>>Palakkad</option>
                        <option value="Pathanamthitta" <?php if (isset($_POST['district']) && $_POST['district'] === 'Pathanamthitta') echo 'selected'; ?>>Pathanamthitta</option>
                        <option value="Thiruvananthapuram" <?php if (isset($_POST['district']) && $_POST['district'] === 'Thiruvananthapuram') echo 'selected'; ?>>Thiruvananthapuram</option>
                        <option value="Thrissur" <?php if (isset($_POST['district']) && $_POST['district'] === 'Thrissur') echo 'selected'; ?>>Thrissur</option>
                        <option value="Wayanad" <?php if (isset($_POST['district']) && $_POST['district'] === 'Wayanad') echo 'selected'; ?>>Wayanad</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="number" name="pincode" id="pincode" class="form-control" placeholder="Enter Pincode" value="<?php echo isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="orderdate" class="form-label">Order Date</label>
                    <input type="date" name="orderdate" id="orderdate" class="form-control" placeholder="Enter Order Date" value="<?php echo isset($_POST['orderdate']) ? htmlspecialchars($_POST['orderdate']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary" value="Submit" onclick="return validatePhoneNumber()">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
