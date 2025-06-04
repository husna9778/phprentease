<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>VOYAGO - Premium Car Rentals</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
  />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body,
    html {
      height: 100%;
      font-family: 'Orbitron', sans-serif;
      color: #fff;
      background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1500&q=80')
        no-repeat center center fixed;
      background-size: cover;
    }

    /* Logo Donut with Curved Text */
    .logo-donut {
      position: relative;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: radial-gradient(circle at center, #00d2ff, #0078a8);
      box-shadow:
        0 0 10px #00d2ff,
        inset 0 0 15px #00d2ff,
        inset 0 10px 20px #00bfff;
      color: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 28px;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      cursor: default;
      text-shadow: 0 0 6px #00bfff;
      z-index: 10;
    }

    .logo-donut::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 45px;
      height: 45px;
      background: #0f0f0f;
      border-radius: 50%;
      transform: translate(-50%, -50%);
      box-shadow: inset 0 0 8px #00334d;
      z-index: -1;
    }

    .logo-donut i {
      z-index: 2;
      position: relative;
    }

    .logo-svg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: visible;
      z-index: 1;
      pointer-events: none;
    }

    .logo-donut:hover {
      animation: pulseGlow 1.5s infinite alternate;
      transform: scale(1.1);
      box-shadow:
        0 0 20px #00eaff,
        inset 0 0 25px #00eaff,
        inset 0 10px 25px #00cfff;
      text-shadow: 0 0 12px #00eaff;
    }

    @keyframes pulseGlow {
      0% {
        box-shadow:
          0 0 15px #00d2ff,
          inset 0 0 20px #00bfff,
          inset 0 10px 20px #0099cc;
      }
      100% {
        box-shadow:
          0 0 30px #00eaff,
          inset 0 0 40px #00eaff,
          inset 0 15px 30px #00d4ff;
      }
    }

    header.navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      background: rgba(0, 0, 0, 0.85);
      border-bottom: 2px solid #00bfff;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    nav {
      flex-grow: 1;
      margin-left: 30px;
    }

    .nav-links {
      display: flex;
      gap: 30px;
      list-style: none;
    }

    .nav-links a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
      position: relative;
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      left: 0;
      bottom: -5px;
      background: #00bfff;
      transition: 0.3s ease;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .nav-actions {
      display: flex;
      align-items: center;
    }

    .search-form input {
      padding: 8px 14px;
      border-radius: 20px;
      border: none;
      width: 170px;
      outline: none;
    }

    .search-form button {
      background: #00bfff;
      border: none;
      margin-left: 8px;
      padding: 8px 14px;
      border-radius: 20px;
      color: white;
      cursor: pointer;
      transition: 0.3s;
    }

    .search-form button:hover {
      background: #0078a8;
    }

    .hero {
      height: calc(100vh - 90px);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      padding: 0 20px;
    }

    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      color: #fff;
      animation: slideUp 1s ease-in-out;
      max-width: 500px;
      width: 100%;
    }

    .hero-content h1 {
      font-size: 3rem;
      margin-bottom: 25px;
    }

    .hero-content span {
      color: #00bfff;
    }

    .hero-content select {
      width: 100%;
      padding: 14px 16px;
      font-size: 18px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    .hero-content select:hover {
      transform: scale(1.05);
    }

    footer {
      background: #101010;
      padding: 30px 20px;
      text-align: center;
      color: #bbb;
      font-size: 15px;
    }

    .footer-content h2 {
      color: #fff;
      margin-bottom: 10px;
    }

    .footer-content h2 span {
      color: #00bfff;
    }

    .footer-content .social-icons {
      margin: 15px 0;
    }

    .social-icons a {
      color: #bbb;
      font-size: 20px;
      margin: 0 10px;
      transition: 0.3s;
    }

    .social-icons a:hover {
      color: #00bfff;
    }

    @keyframes slideUp {
      from {
        transform: translateY(50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      header.navbar {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        padding: 15px 20px;
      }

      nav {
        margin-left: 0;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
      }

      .hero-content h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <header class="navbar">
    <div class="logo-donut" aria-label="Voyago logo">
      <!-- Curved Text -->
      <svg viewBox="0 0 120 120" class="logo-svg">
        <defs>
          <path id="curve" d="M60,10 a50,50 0 1,1 -0.1,0" />
        </defs>
        <text fill="#00d2ff" font-size="10" font-family="'Orbitron', sans-serif">
          <textPath xlink:href="#curve" startOffset="50%" text-anchor="middle">VOYAGO</textPath>
        </text>
      </svg>
      <i class="bi bi-car-front"></i>
    </div>

    <nav>
      <ul class="nav-links">
        <li><a href="homepagee.php">Home</a></li>
        <li><a href="vehicle.php">Vehicles</a></li>
        <li><a href="offer.php">Offers</a></li>
          <li><a href="profile.php">Profile </a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="aboutus.php">About Us</a></li>
      </ul>
    </nav>

    <div class="nav-actions">
      <form action="search.php" method="get" class="search-form d-flex" role="search">
        <input type="search" name="search_query" placeholder="Search..." aria-label="Search cars" />
        <button type="submit" aria-label="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>
        Find the Best <span>Luxury</span> Car Rentals
      </h1>
      <form>
        <select onchange="window.location.href=this.value" aria-label="Select Car Brand">
          <option value="" disabled selected hidden>Select Car Brand</option>
          <option value="honda.php">Honda</option>
          <option value="suzuki.php">Suzuki</option>
          <option value="toyota.php">Toyota</option>
        </select>
      </form>
    </div>
  </section>

  <footer>
    <div class="footer-content">
      <h2>voya<span>go</span></h2>
      <p>It’s a never-ending battle of sharing your best talent and striving to improve yourself.</p>
      <div class="social-icons">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-linkedin"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
      </div>
      <p>&copy; 2025 All Rights Reserved by VOYAGO</p>
    </div>
  </footer>

</body>
</html>
