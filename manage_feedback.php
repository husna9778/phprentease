<?php
session_start();

// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentease";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all feedback ordered by newest first
$sql = "SELECT name, feedback, rating, submitted_at FROM feedback ORDER BY submitted_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Feedback View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f4f4f9;
            color: #333;
        }
        h1 {
            color: #444;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 25px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f7f1;
        }
        .stars {
            color: #FFD700;
            font-size: 18px;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>

<h1>Feedback Admin Panel</h1>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Feedback</th>
                <th>Rating</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['feedback'])) ?></td>
                    <td class="stars">
                        <?php
                            // Show stars according to rating
                            for ($i = 0; $i < (int)$row['rating']; $i++) {
                                echo "★";
                            }
                            for ($i = (int)$row['rating']; $i < 5; $i++) {
                                echo "☆";
                            }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($row['submitted_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No feedback submitted yet.</p>
<?php endif; ?>

<?php
$conn->close();
?>

</body>
</html>
