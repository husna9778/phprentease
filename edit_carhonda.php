
aa
<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Fetch car details from database
$id = $_GET['id'];
$query = "SELECT * FROM carssss WHERE id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Update car details
if (isset($_POST['btnSubmit'])) {
    $name = htmlspecialchars($_POST["name"]);
    $model = htmlspecialchars($_POST["model"]); // Get the model value
    $price = htmlspecialchars($_POST["price"]);
    if ($_FILES["image"]["name"] != "") {
        $image = "images/" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    } else {
        $image = $row['image'];
    }
    $query = "UPDATE carssss SET name='$name', model='$model', price='$price', image='$image' WHERE id='$id'";
    mysqli_query($con, $query);
    header("Location: manage_honda.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="card w-50">
                <div class="card-header">
                    <h1 class="card-title">Edit Car</h1>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" id="model" class="form-control" value="<?php echo $row['model']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="<?php echo $row['price']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="<?php echo $row['image']; ?>" width="100" height="100">
                    </div>
                    <input type="submit" name="btnSubmit" value="Update">
                </div>
            </div>
        </form>
    </div>
</body>
</html>


