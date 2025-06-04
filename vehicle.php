
<?php
// cars.php

// Available cars
$cars = array(
    array(
        "brand" => "Suzuki",
        "model" => "Jimny",
        "image" => "images/jimny2017.jpeg"
    ),
    array(
        "brand" => "Toyota",
        "model" => "Corolla",
        "image" => "images/toyota2025.jpeg"
    ),
    array(
        "brand" => "Honda",
        "model" => "Civic",
        "image" => "images/civic2023.jpeg"
    )
);

// Include the header
?>

<!-- Cars Section -->
<style>
    .cars {
        background-color: #f0f0f0;
        padding: 40px;
    }

    .car-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .car {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .car h2 {
        color: #00698f;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .car img {
        width: 200px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
    }
</style>

<section class="cars">
    <div class="container">
        <h1 style="color:rgb(143, 0, 14);">Available Cars</h1>
        <div class="car-list">
            <?php foreach ($cars as $car) { ?>
                <div class="car">
                    <h2><?php echo $car['brand'] . " " . $car['model']; ?></h2>
                    <img src="<?php echo $car['image']; ?>" alt="<?php echo $car['brand'] . " " . $car['model']; ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
// Include the footer
?>


