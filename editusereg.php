<?php
require_once "db.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $sql = "UPDATE users SET fullname = '$fullname', email = '$email' WHERE id = '$id'";
  mysqli_query($conn, $sql);
  header("Location: userreg.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="adminhome.css">
</head>
<body>
  <div class="main-content">
    <h1>Edit User</h1>
    <form action="" method="post">
      <label for="fullname">Full Name:</label>
      <input type="text" name="fullname" value="<?php echo $row['fullname']; ?>"><br><br>
      <label for="email">Email:</label>
      <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
      <input type="submit" name="update" value="Update">
    </form>
  </div>
</body>
</html>

