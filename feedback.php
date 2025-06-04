<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentease";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $feedback = $rating = "";
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize inputs
    if (!empty($_POST['name']) && !empty($_POST['feedback']) && !empty($_POST['Rating'])) {
        $name = $conn->real_escape_string(trim($_POST['name']));
        $feedback = $conn->real_escape_string(trim($_POST['feedback']));
        $rating = (int) $_POST['Rating'];

        if ($rating < 1 || $rating > 5) {
            $error = "Invalid rating value.";
        } else {
            // Insert into database
            $sql = "INSERT INTO feedback (name, feedback, rating, submitted_at) VALUES ('$name', '$feedback', $rating, NOW())";

            if ($conn->query($sql) === TRUE) {
                $success = "Thank you for your feedback!";
                // Clear form fields
                $name = $feedback = $rating = "";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    } else {
        $error = "Please fill all the fields and select a rating.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Feedback Page</title>
    <style>
        /* Your existing CSS here */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1, h2 {
            color: #444;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 500px;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .rating input:checked ~ label, .rating label:hover, .rating label:hover ~ label {
            color: #FFD700;
        }
        .message {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Leave Your Feedback</h1>

    <?php if ($success): ?>
        <p class="message success"><?= htmlspecialchars($success) ?></p>
    <?php elseif ($error): ?>
        <p class="message error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form id="feedbackForm" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <input name="name" type="text" id="name" placeholder="Your name" required value="<?= htmlspecialchars($name) ?>">
        <textarea name="feedback" id="message" rows="4" placeholder="Your feedback" required><?= htmlspecialchars($feedback) ?></textarea>
        <div class="rating">
            <?php
            // Generate rating inputs dynamically so selected rating persists
            for ($i = 5; $i >= 1; $i--) {
                $checked = ($rating == $i) ? "checked" : "";
                echo '<input type="radio" name="Rating" id="star' . $i . '" value="' . $i . '" ' . $checked . ' required>';
                echo '<label for="star' . $i . '">★</label>';
            }
            ?>
        </div>
        <button type="submit">Submit Feedback</button>
    </form>
</body>
</html>
