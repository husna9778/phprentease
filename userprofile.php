Here's the full code for a user profile page with image upload functionality:


<?php 
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease");

// Check if the form is submitted
if (isset($_FILES['image'])) {
    $user_id = 1; // Replace with the actual user ID
    $image = $_FILES['image'];

    // Check if the image is valid
    if ($image['error'] == 0) {
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_size = $image['size'];

        // Move the uploaded image to the images folder
        $image_path = 'images/' . $image_name;
        move_uploaded_file($image_tmp_name, $image_path);

        // Update the user image in the database
        $query = "UPDATE users SET image = '$image_path' WHERE id = '$user_id'";
        mysqli_query($con, $query);
    }
}

// Fetch user data
$user_id = 1; // Replace with the actual user ID
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="userprofile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        .profile-container {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-bottom: 1px solid #333;
        }

        .profile-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .profile-picture {
            margin-right: 20px;
            text-align: center;
        }

        .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-picture input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .profile-picture button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        .profile-details {
            flex: 1;
        }

        .profile-actions {
            margin-top: 20px;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>User Profile</h1>
        </div>
        <div class="profile-info">
            <div class="profile-picture">
                <img src="<?php echo $user_data['image']; ?>" alt="Profile Picture">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="image" accept="image/*">
                    <button type="submit">Upload Image</button>
                </form>
            </div>
            <div class="profile-details">
                <h2><?php echo $user_data['name']; ?></h2>
                <p>Email: <?php echo $user_data['email']; ?></p>
                <p>Phone: <?php echo $user_data['phone']; ?></p>
                <p>Address: <?php echo $user_data['address']; ?></p>
            </div>
        </div>
        <div class="profile-actions">
            <button>Edit Profile</button>
            <button>Change Password</button>
        </div>
    </div>
</body>
</html>
