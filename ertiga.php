<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Fetch cars from database
$query = "SELECT * FROM carss";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="cards.css">
    <style>
        body {
            background-color: #000;
        }
        .card {
            position: relative;
        }
        .card a.float-end {
            color: #fff;
            text-decoration: none;
            font-size: 10px;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
        .card a.float-end:hover {
            color: #ccc;
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
                            <p class="card-text"><?php echo $row['name']; ?> <?php echo $row['model']; ?><br><span style="color: yellow;"><?php echo $row['price']; ?></span></p>
                            <form action="brezza2025.php" method="post">
                                <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
                                <input type="radio" name="paymentplan" value="20000/month"> 20000/month<br>
                                <input type="radio" name="paymentplan" value="120000/6month"> 120000/6month<br>
                                <input type="radio" name="paymentplan" value="240000/year"> 240000/year<br>
                                <button class="btn btn-primary" type="submit">Buy Now</button>
                            </form>
                            <a href="brezzadtls.php" class="float-end">More Information</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

