<?php
// Your order confirmation logic here
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmed</title>
  <link rel="stylesheet" href="confirmation.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    .card {
      width: 300px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .tick-mark {
      font-size: 48px;
      color: #4CAF50;
    }
  </style>
</head>
<body>
  <div class="card">
    <p class="tick-mark">&#10004;</p>
    <h2>Order Confirmed Successfully!</h2>
    <p>Your order has been confirmed and will be processed shortly.</p>
    <button class="btn" onclick="window.location.href='homepagee.php'">Back to Home</button>

  </div>
</body>
</html>
