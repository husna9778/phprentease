<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "rentease") or die('Connection Error');

// Add post
if (isset($_POST['btnSubmit'])) {
    $name = htmlspecialchars($_POST["name"]);
    $model = htmlspecialchars($_POST["model"]);
    $price = htmlspecialchars($_POST["price"]);
    $image = "images/" . $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);

    if (isset($_POST["brand"])) {
        $brand = htmlspecialchars($_POST["brand"]);
        if ($brand == "Suzuki") {
            $query = "INSERT INTO carss (name, model, price, image) VALUES ('$name', '$model', '$price', '$image')";
        } elseif ($brand == "Toyota") {
            $query = "INSERT INTO carsss (name, model, price, image) VALUES ('$name', '$model', '$price', '$image')";
        } elseif ($brand == "Honda") {
            $query = "INSERT INTO carssss (name, model, price, image) VALUES ('$name', '$model', '$price', '$image')";
        }

        if (isset($query)) {
            mysqli_query($con, $query);
            if ($brand == "Suzuki") {
                header("Location: Suzuki.php");
            } elseif ($brand == "Toyota") {
                header("Location: Toyota.php");
            } elseif ($brand == "Honda") {
                header("Location: Honda.php");
            }
            exit;
        } else {
            echo "Invalid brand selected.";
        }
    } else {
        echo "Please select a brand.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="card w-50">
                <div class="card-header">
                    <h1 class="card-title">Add Post</h1>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" id="model" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label><br>
                        <input type="radio" name="brand" value="Suzuki" required> Suzuki
                        <input type="radio" name="brand" value="Toyota" required> Toyota
                        <input type="radio" name="brand" value="Honda" required> Honda
                    </div>
                    <input type="submit" name="btnSubmit" value="Add Post">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
