

<?php 
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Fetch cars from database
$query = "SELECT * FROM carss";
$result = mysqli_query($con, $query) or die(mysqli_error($con));

// Define payment plans for each car
$paymentPlans = array(
  array('18000/month', '108000/6month', '210000/year'),
  array('20000/month', '120000/6month', '240000/year'),
  array('7000/month', '42000/6month', '84000/year'),
  array('15000/month', '90000/6month', '180000/year'),
  array('14000/month', '84000/6month', '168000/year'),
  array('8000/month', '48000/6month', '96000/year'),
  array('28000/month', '168000/6month', '336000/year'),
  array('28000/month', '168000/6month', '336000/year'),
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
      width: 250px;
      padding: 10px;
      background-color: rgb(245, 240, 240);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      height: 350px;
      overflow-y: auto;
    }
    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 10px 10px 0 0;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-3">
          <div class="card">
            <img src="<?php echo $row['image']; ?>" alt="...">
            <div class="card-body">
              <p class="card-text"><?php echo $row['name']; ?><br>Model: <?php echo $row['model']; ?><br><span style="color: black;"><?php echo $row['price']; ?></span></p>
              <form>
                <?php foreach ($paymentPlans[$i] as $plan) { ?>
                  <input type="radio" name="paymentplan" value="<?php echo $plan; ?>"> <?php echo $plan; ?><br>
                <?php } ?>
              </form>
              <a href="edit_car.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
              <a href="delete_car.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
        <?php $i++; ?>
      <?php } ?>
    </div>
  </div>
</body>
</html>


