<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Cancel rent functionality
if (isset($_GET['action']) && $_GET['action'] == 'cancel_rent') {
    $car_id = $_GET['car_id'];
    $query = "UPDATE carss SET status = 'available' WHERE id = '$car_id'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    header('Location: rented_car.php');
    exit;
}

// Fetch rented cars from database
$query = "SELECT * FROM carss WHERE status = 'rented'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<style>
  .rented-scroll-container {
    display: flex;
    overflow-x: auto;
    padding: 20px 10px;
    gap: 15px;
    scroll-behavior: smooth;
  }
  .rented-scroll-container::-webkit-scrollbar {
    height: 8px;
  }
  .rented-scroll-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
  }
  .rented-card {
    flex: 0 0 auto; /* Don't shrink, don't grow */
    width: 180px;
    height: 320px;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    background: #fff;
  }
  .rented-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.25);
  }
  .rented-card img {
    height: 140px;
    width: 100%;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
  }
  .rented-card-body {
    padding: 10px 12px;
    text-align: center;
  }
  .rented-card-body p {
    font-size: 14px;
    margin-bottom: 6px;
    color: #333;
    font-weight: 600;
  }
  .rented-status {
    color: #d9534f;
    font-weight: 700;
    margin-bottom: 10px;
  }
  .cancel-btn {
    width: 100%;
    font-size: 14px;
    padding: 8px 0;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }
  .cancel-btn:hover {
    background-color: #c9302c;
  }
</style>

<div class="rented-scroll-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="rented-card">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <div class="rented-card-body">
                <p><?php echo htmlspecialchars($row['name']); ?></p>
                <p style="font-weight: normal; font-size: 13px;">Model: <?php echo htmlspecialchars($row['model']); ?></p>
                <p style="font-weight: normal; font-size: 13px; color: #444;">Price: <?php echo htmlspecialchars($row['price']); ?></p>
                <p class="rented-status">Rented</p>
                <a href="rented_car.php?car_id=<?php echo $row['id']; ?>&action=cancel_rent" class="btn btn-danger cancel-btn">Cancel</a>
            </div>
        </div>
    <?php } ?>
    <?php if (mysqli_num_rows($result) == 0) { ?>
      <p class="text-center text-muted">No cars are currently rented.</p>
    <?php } ?>
</div>
