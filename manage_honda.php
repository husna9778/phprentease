<?php 
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Fetch cars from database
$query = "SELECT * FROM carssss";
$result = mysqli_query($con, $query) or die(mysqli_error($con));

// Define payment plans for each car
$paymentPlans = array(
    array('19000/month', '114000/6month', '228000/year'),
    array('20000/month', '120000/6month', '240000/year'),
    array('24000/month', '144000/6month', '288000/year'),
    array('25000/month', '150000/6month', '300000/year'),
);

$i = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
        }
        .card {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-3">
                    <div class="card bg-dark text-white" style="width: 15rem;">
                        <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><?php echo $row['name']; ?><br><span style="color: yellow;"><?php echo $row['price']; ?></span></p>
                            <form>
                                <input type="radio" name="paymentplan" value="18000/month"> 18000/month<br>
                                <input type="radio" name="paymentplan" value="108000/6month"> 108000/6month<br>
                                <input type="radio" name="paymentplan" value="216000/year"> 216000/year<br>
                            </form>
                            <a href="edit_carhonda.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="dtl_carhonda.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
