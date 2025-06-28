<?php
include_once "config.php";   // Database config & connection
include_once "header.php";   // Navbar and header HTML
?>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    background: #f5f5f5;
    color: #333;
  }

  .hero {
    background: url('https://images.hgmsites.net/hug/2020-bmw-x5-series_100728662_h.jpg') center center/cover no-repeat;
    height: 90vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    position: relative;
  }

  .hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
  }

  .hero-content {
    position: relative;
    max-width: 600px;
    z-index: 1;
  }

  .hero-content h1 {
    font-size: 3rem;
    margin-bottom: 15px;
    text-shadow: 0 2px 6px rgba(0,0,0,0.7);
  }

  .hero-content p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    text-shadow: 0 1px 4px rgba(0,0,0,0.6);
  }

  .btn-primary {
    background-color: #f7941d;
    color: white;
    font-weight: 700;
    padding: 14px 35px;
    border-radius: 6px;
    font-size: 1.1rem;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 12px rgb(247 148 29 / 0.5);
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #e88312;
  }
</style>

<section class="hero" role="banner" aria-label="Welcome section">
  <div class="hero-content">
    <h1>Rent Your Perfect Car in Prishtina</h1>
    <p>Affordable prices, great service, and a wide selection of vehicles to fit your needs.</p>
    <button class="btn-primary" onclick="window.location.href='list_cars.php'">View Cars</button>
  </div>
</section>

<?php include_once "footer.php"; ?>
