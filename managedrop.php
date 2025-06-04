<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Rent a Car</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    <main class="main-container">
        <div class="booking-form">
            <select onchange="window.location.href=this.value">
                <option value="" selected disabled hidden>Car type</option>
                <option value="manage_honda.php">HONDA</option>
                <option value="manage_suzuki.php">SUZUKI</option>
                <option value="manage_toyota.php">TOYOTA</option>
                <option value="#">MERCEDES</option>
                <option value="#">LAND ROVER</option>
            </select>
        </div>
    </main>
</body>
</html>
