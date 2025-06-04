


<?php require_once "db.php"; $sql = "SELECT * FROM users"; $result = mysqli_query($conn, $sql); ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Manage Users</title> 
  <link rel="stylesheet" href="adminhome.css"> 
</head> 
<body> 
  <div class="main-content"> 
    <h1>Manage Users</h1> 
    <table> 
      <thead> 
        <tr> 
          <th>ID</th> 
          <th>Full Name</th> 
          <th>Email</th> 
          <th>Actions</th> 
        </tr> 
      </thead> 
      <tbody> 
        <?php while ($row = mysqli_fetch_assoc($result)) { ?> 
        <tr> 
          <td><?php echo $row['id']; ?></td> 
          <td><?php echo $row['fullname']; ?></td> 
          <td><?php echo $row['email']; ?></td> 
          <td>
            <a href="editusereg.php?id=<?php echo $row['id']; ?>">Edit</a> | 
            <a href="dltusereg.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
          </td> 
        </tr> 
        <?php } ?> 
      </tbody> 
    </table> 
  </div> 
</body> 
</html>


