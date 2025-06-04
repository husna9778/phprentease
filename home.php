<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rento - Rent a Car</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">RENTO</div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Prices</a></li>
                <li><a href="#">Vehicles</a></li>
                <li><a href="#">Offers</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
        <div class="nav-actions">
            <button class="signup-btn">Sign Up</button>
            <input type="search" placeholder="Search">
        </div>
        
    </header>

    <!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div> -->





    <main class="main-container">
        <div class="booking-form">
        <h2 style="font-size: 50px;">Best luxury Car &nbsp;<br><span style="font-weight: bold; font-size: 27px;">Rental Deals</span></h2>
        <form>
        <select onchange="window.location.href=this.value">
  <option value="" selected disabled hidden><b>Car type</b></option>
  <option value="honda.php">HONDA</option>
  <option value="suzuki.php">SUZUKI</option>
  <option value="toyota.php">TOYOTA</option>
  <option value="#">MERCEDES</option>
  <option value="#">LAND ROVER</option>
</select>



                    
                </select>
                <input type="text" placeholder="Where are you now">
                <input type="text" placeholder="Where do you want to go">
                <div class="date-inputs">
                    <input type="date">
                    <input type="date">
                </div>
                <button class="reserve-btn">Reserve Now</button>
            </form>
        </div>
    </main>
</body>
</html>
