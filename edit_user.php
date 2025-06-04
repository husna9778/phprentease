<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: adminlogin.php');
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "rentease");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    $query = "UPDATE users SET full_name = '$full_name', email = '$email' WHERE id = '$id'";
    mysqli_query($conn, $query);

    header('Location: admin_dashboard.php');
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>"><br><br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
        <input type="submit" name="submit" value="Save Changes">
    </form>
</body>
</html>
