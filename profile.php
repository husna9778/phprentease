<?php
session_start();
require 'database.php'; // Make sure this sets up $conn

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
 
    $photo_name = null;

    // Photo handling
    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        $photo_name = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo_name;
        // Ensure the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Photo uploaded successfully
        } else {
            $message = "Error uploading photo.";
        }
    }

    // Update query
    $sql = "UPDATE users SET fullname=?, email=?";
    $params = [$name, $email];
    $types = "ss";

    if (!empty($new_password)) {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $sql .= ", password=?";
        $params[] = $hashed;
        $types .= "s";
    }

    if ($photo_name) {
        $sql .= ", photo=?";
        $params[] = $photo_name;
        $types .= "s";
    }

    $sql .= " WHERE id=?";
    $params[] = $user_id;
    $types .= "i";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
}

// Load current user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://source.unsplash.com/random/1920x1080/?abstract,texture'); /* Dynamic background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Keeps background fixed on scroll */
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md backdrop-blur-sm bg-opacity-80">
        <div class="flex flex-col items-center mb-6">
            <?php if (!empty($user['photo'])): ?>
                <img src="uploads/<?= htmlspecialchars($user['photo']) ?>" class="w-32 h-32 rounded-full object-cover border-4 border-teal-500 shadow-md" alt="Profile Photo">
            <?php else: ?>
                <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-6xl font-bold border-4 border-teal-500 shadow-md">
                    ?
                </div>
            <?php endif; ?>
            <h2 class="text-3xl font-extrabold text-center mt-4 text-teal-800">Edit Your Profile</h2>
        </div>

        <?php if ($message): ?>
            <div class="bg-teal-100 text-teal-800 p-3 rounded mb-4 text-center font-medium">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block mb-1 text-sm font-semibold text-gray-700">Full Name</label>
                <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200">
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200">
            </div>

            

            <div class="mb-6">
                <label class="block mb-1 text-sm font-semibold text-gray-700">Upload New Photo</label>
                <input type="file" name="photo" accept="image/*" class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
            </div>

            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-md transition duration-300 ease-in-out transform hover:scale-105">
                Save Changes
            </button>
        </form>
    </div>
</body>
</html>