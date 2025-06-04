<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentease";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming admin id = 1 for demo
$adminId = 1;

// Fetch admin profile securely with prepared statement
$adminName = "Admin";
$adminPhoto = "uploads/admin_photo_1.jpeg";

$stmt = $conn->prepare("SELECT name, photo FROM admin WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $adminId);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    $adminRow = $result->fetch_assoc();
    $adminName = $adminRow['name'];
    if (!empty($adminRow['photo'])) {
        $adminPhoto = $adminRow['photo'];
    }
}
$stmt->close();

// Handle photo upload
$uploadError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $file = $_FILES['profile_photo'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($ext, $allowed)) {
        $uploadError = "Invalid file type. Allowed types: jpg, jpeg, png, gif.";
    } elseif ($file['size'] > 2 * 1024 * 1024) { // 2MB limit
        $uploadError = "File size exceeds 2MB limit.";
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadError = "Upload error code: " . $file['error'];
    } else {
        $newFileName = 'admin_photo_' . $adminId . '.' . $ext;
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $photoPath = 'uploads/' . $newFileName;
            $stmt = $conn->prepare("UPDATE admin SET photo = ? WHERE id = ?");
            $stmt->bind_param("si", $photoPath, $adminId);
            $stmt->execute();
            $stmt->close();

            // Redirect to prevent resubmission on refresh
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $uploadError = "Failed to move uploaded file.";
        }
    }
}

// Prepare last 7 days data for registrations
$last7Days = [];
$registrationsData = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $last7Days[] = date('D', strtotime($date));

    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users WHERE DATE(registration_date) = ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $registrationsData[] = (int)$row['count'];
    $stmt->close();
}

// Get counts for cars from each table safely
$carssCount = 0;
$carsssCount = 0;
$carssssCount = 0;

foreach (['carss', 'carsss', 'carssss'] as $table) {
    $res = $conn->query("SELECT COUNT(*) as cnt FROM $table");
    if ($res) {
        $count = $res->fetch_assoc()['cnt'] ?? 0;
        if ($table === 'carss') $carssCount = (int)$count;
        elseif ($table === 'carsss') $carsssCount = (int)$count;
        else $carssssCount = (int)$count;
    }
}

$totalUsers = 0;
$res = $conn->query("SELECT COUNT(*) as total FROM users");
if ($res) $totalUsers = (int)($res->fetch_assoc()['total'] ?? 0);

$totalCars = $carssCount + $carsssCount + $carssssCount;

// Active users (last_login assumed UNIX timestamp)
$activeUsers = 0;
// FIXED QUERY: Compare last_login UNIX timestamp with UNIX_TIMESTAMP() of 7 days ago
$activeUsersQuery = "SELECT COUNT(*) as active FROM users WHERE last_login >= UNIX_TIMESTAMP(NOW() - INTERVAL 7 DAY)";
$activeUsersResult = $conn->query($activeUsersQuery);
if ($activeUsersResult) {
    $activeUsers = (int)($activeUsersResult->fetch_assoc()['active'] ?? 0);
}

// Total bookings
$totalBookings = 0;
$res = $conn->query("SELECT COUNT(*) as total FROM bookings");
if ($res) $totalBookings = (int)($res->fetch_assoc()['total'] ?? 0);

// Total feedback
$totalFeedback = 0;
$res = $conn->query("SELECT COUNT(*) as total FROM feedback");
if ($res) $totalFeedback = (int)($res->fetch_assoc()['total'] ?? 0);

$carCategories = ['Suzuki', 'Toyota', 'Honda'];
$carCounts = [$carssCount, $carsssCount, $carssssCount];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7f6;
    }
    .sidebar {
      background-color: #222831;
      min-height: 100vh;
    }
    .sidebar .nav-link {
      color: #eeeeee;
    }
    .sidebar .nav-link.active {
      background-color: #00adb5;
      color: #222831;
      font-weight: 600;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    .card h5 {
      font-weight: 600;
    }
    .chart-container {
      height: 240px;
    }
  </style>
</head>

<body>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar pt-4">
      <h2 class="text-light ps-3 pb-4">Voyago</h2>

      <div class="text-center mb-4">
        <img src="<?= htmlspecialchars($adminPhoto) ?>" alt="Admin Photo" class="rounded-circle" style="width:100px; height:100px; object-fit:cover; border: 3px solid #00adb5;">
        <h5 class="text-light mt-2"><?= htmlspecialchars($adminName) ?></h5>
      </div>

      <ul class="nav flex-column ps-3">
        <li class="nav-item">
          <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rented_car.php"><i class="fas fa-car me-2"></i> Rented Cars</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="managedrop.php"><i class="fas fa-cog me-2"></i> Manage Cars</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="userreg.php"><i class="fas fa-users me-2"></i> User Registration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="managepost.php"><i class="fas fa-user me-2"></i> Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addpost.php"><i class="fas fa-user me-2"></i> Addpost</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage_feedback.php"><i class="fas fa-comments me-2"></i> Feedback</a>
        </li>
      </ul>
    </nav>

    <main class="col-md-10 ms-sm-auto px-md-4 pt-4">
      <h1 class="h2 mb-4">Welcome Back, Admin 👋</h1>

      <div class="row mb-4">
        <div class="col-md-3">
          <div class="card p-4 text-center bg-white">
            <h5>Total Registered Users</h5>
            <h2 class="text-primary"><?= $totalUsers ?></h2>
            <i class="fas fa-users fa-2x text-primary"></i>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-4 text-center bg-white">
            <h5>Total Cars in System</h5>
            <h2 class="text-success"><?= $totalCars ?></h2>
            <i class="fas fa-car fa-2x text-success"></i>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-4 text-center bg-white">
            <h5>Active Users (7 Days)</h5>
            <h2 class="text-warning"><?= $activeUsers ?></h2>
            <i class="fas fa-user-check fa-2x text-warning"></i>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card p-4 text-center bg-white">
            <h5>Total Feedback</h5>
            <h2 class="text-info"><?= $totalFeedback ?></h2>
            <i class="fas fa-comments fa-2x text-info"></i>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card p-3 bg-white">
            <h5 class="mb-3">New User Registrations (Last 7 Days)</h5>
            <div class="chart-container">
              <canvas id="usersLineChart"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6 mb-4">
          <div class="card p-3 bg-white">
            <h5 class="mb-3">Cars Count per Table</h5>
            <div class="chart-container">
              <canvas id="carsPieChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
const usersLineChart = new Chart(document.getElementById('usersLineChart').getContext('2d'), {
  type: 'line',
  data: {
    labels: <?= json_encode($last7Days) ?>,
    datasets: [{
      label: 'New Users',
      data: <?= json_encode($registrationsData) ?>,
      fill: true,
      backgroundColor: 'rgba(0, 173, 181, 0.3)',
      borderColor: '#00adb5',
      borderWidth: 3,
      tension: 0.3,
      pointBackgroundColor: '#00adb5',
      pointRadius: 5,
      pointHoverRadius: 7,
      pointHoverBackgroundColor: '#007d85'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: { stepSize: 1 }
      }
    },
    plugins: {
      legend: { display: true, labels: { color: '#222831', font: { weight: '600', size: 14 } } },
      tooltip: {
        mode: 'index',
        intersect: false,
        backgroundColor: '#00adb5',
        titleColor: '#fff',
        bodyColor: '#fff',
        cornerRadius: 6,
        padding: 10,
      }
    },
    interaction: {
      mode: 'nearest',
      axis: 'x',
      intersect: false
    }
  }
});

const carsPieChart = new Chart(document.getElementById('carsPieChart').getContext('2d'), {
  type: 'doughnut',
  data: {
    labels: <?= json_encode($carCategories) ?>,
    datasets: [{
      label: 'Cars per Table',
      data: <?= json_encode($carCounts) ?>,
      backgroundColor: ['#00adb5', '#393e46', '#f38181'],
      hoverOffset: 20,
      borderWidth: 2,
      borderColor: '#f4f7f6'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { position: 'right', labels: { font: { size: 14, weight: '600' } } }
    }
  }
});
</script>
</body>
</html>
