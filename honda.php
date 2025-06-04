

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
  <title>Honda Cars</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

  body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: url('images/bg-luxury-car.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
    position: relative;
  }

  body::before {
    content: "";
    position: fixed;
    top: 0; left: 0; bottom: 0; right: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: -1;
  }

  .container-fluid {
    padding: 40px 20px;
  }

  .card {
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    color: #fff;
    margin: 20px auto;
    overflow: hidden;
    transition: transform 0.3s ease;
    width: 100%;
    max-width: 260px;
  }

  .card:hover {
    transform: translateY(-5px) scale(1.02);
  }

  .card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 20px 20px 0 0;
  }

  .card-body {
    padding: 15px;
  }

  .card-text {
    margin-bottom: 15px;
    font-size: 14px;
    color: #f8f8f8;
  }

  .btn-primary {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    border: none;
    width: 100%;
    font-weight: bold;
    padding: 8px 0;
    border-radius: 10px;
    transition: background 0.3s ease;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #ff4b2b, #ff416c);
  }

  input[type="radio"] {
    margin-right: 8px;
  }

  .row {
    justify-content: center;
  }

  @media (max-width: 768px) {
    .col-md-3 {
      width: 100%;
      max-width: 320px;
    }
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
              <form action="brezza2025.php" method="post">
                <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
                <?php foreach ($paymentPlans[$i] as $plan) { ?>
                  <input type="radio" name="paymentplan" value="<?php echo $plan; ?>" required> <?php echo $plan; ?><br>
                <?php } ?>
                <button class="btn btn-primary" type="submit">Buy Now</button>
              </form>
            </div>
          </div>
        </div>
        <?php $i++; ?>
      <?php } ?>
    </div>
  </div>
</body>
</html>
