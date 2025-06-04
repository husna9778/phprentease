<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Search query
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $query = "
        SELECT name, model, price, image FROM carssss 
        WHERE name LIKE '%$search_query%' 
        OR model LIKE '%$search_query%' 
        UNION 
        SELECT name, '' AS model, price, image FROM carss
        WHERE name LIKE '%$search_query%'
        UNION 
        SELECT name, '' AS model, price, image FROM carsss
        WHERE name LIKE '%$search_query%'
    ";
    $result = mysqli_query($con, $query);
    if (!$result) {
        die(mysqli_error($con));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-3">
                        <div class="card bg-dark text-white" style="width: 15rem;">
                            <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><?php echo $row['name']; ?> <?php echo $row['model']; ?><br><span style="color: yellow;"><?php echo $row['price']; ?></span></p>
                                <button class="btn btn-primary" onclick="window.location.href='<?php echo strtolower($row['name']) . strtolower($row['model']) . '.php'; ?>'">Buy Now</button>
                                <a href="<?php echo strtolower($row['name']) . strtolower($row['model']) . 'dtls.php'; ?>" class="float-end">More Information</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No results found.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
<?php } ?>
