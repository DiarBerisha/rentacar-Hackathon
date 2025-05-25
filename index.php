<?php include_once "config.php";

include_once "header.php"; ?>

<style>
  /* Basic Reset */
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    color: #333;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  /* Navbar from before - add your improved navbar here */
  /* (Include your navbar CSS & HTML here or call your header.php navbar) */

  /* Hero Section */
  .hero {

    height: 95vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    padding: 0 20px;
    position: relative;
  }

  .hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 0;
  }

  .hero-content {
    position: relative;
    z-index: 1;
    max-width: 600px;
  }

  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(40px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .hero-content {
    opacity: 0;
    transform: translateY(40px);
    animation: fadeInUp 1s ease-out forwards;
    animation-delay: 0.3s;
  }

  .hero-content>* {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease-out forwards;
  }

  .hero-content h1 {
    animation-delay: 0.3s;
  }

  .hero-content p {
    animation-delay: 0.6s;
  }

  .hero-content .btn-primary {
    animation-delay: 0.9s;
  }



  .hero-content h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.1;
    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.7);
  }

  .hero-content p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
  }

  .hero-content .btn-primary {
    background-color: #f7941d;
    color: white;
    font-weight: 700;
    padding: 14px 35px;
    border-radius: 6px;
    font-size: 1.1rem;
    box-shadow: 0 6px 12px rgb(247 148 29 / 0.5);
    transition: background-color 0.3s ease;
    border: none;
    cursor: pointer;
  }

  .hero-content .btn-primary:hover {
    background-color: #e88312;
  }

  /* Search Form Section */
  .search-section {
    background: white;
    max-width: 900px;
    margin: -70px auto 60px;
    padding: 30px 35px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgb(0 0 0 / 0.1);
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: center;
    justify-content: center;
    margin-top: 60px;
  }

  .search-section label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    font-size: 14px;
    color: #555;
  }

  .search-section select,
  .search-section input[type="date"] {
    padding: 10px 12px;
    font-size: 16px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    min-width: 140px;
    transition: border-color 0.3s ease;
  }

  .search-section select:focus,
  .search-section input[type="date"]:focus {
    border-color: #f7941d;
    outline: none;
  }

  .search-section .form-group {
    flex: 1 1 180px;
    min-width: 160px;
  }

  .search-section button {
    background-color: #f7941d;
    color: white;
    font-weight: 700;
    font-size: 18px;
    border: none;
    padding: 14px 40px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    align-self: flex-end;
    min-width: 160px;
    margin-top: 24px;
  }

  .search-section button:hover {
    background-color: #e88312;
  }

  /* Info Cards Section */
  .info-cards {
    max-width: 1100px;
    margin: 0 auto 80px;
    padding: 0 20px;
    display: flex;
    gap: 28px;
    flex-wrap: wrap;
    justify-content: center;
  }

  .card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgb(0 0 0 / 0.1);
    flex: 1 1 260px;
    padding: 30px 25px;
    text-align: center;
    transition: box-shadow 0.3s ease;
  }

  .card {
    opacity: 0;
    transform: translateX(80px);
    /* default */
    transition: opacity 0.6s ease, transform 0.6s ease;
  }

  .card[data-direction="left"] {
    transform: translateX(-80px);
  }

  .card.visible {
    opacity: 1;
    transform: translateX(0);
  }


  .card:hover {
    box-shadow: 0 12px 40px rgb(247 148 29 / 0.3);
  }

  .card h3 {
    color: #f7941d;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 22px;
  }

  .card p {
    color: #555;
    font-size: 15px;
    line-height: 1.5;
  }

  /* Footer Placeholder */
  footer {
    background: #222;
    color: #aaa;
    text-align: center;
    padding: 30px 20px;
    font-size: 14px;
  }

  .hero {
    background: url(https://images.hgmsites.net/hug/2020-bmw-x5-series_100728662_h.jpg) center center / cover no-repeat;

  }


  /* Responsive */
  @media (max-width: 768px) {
    .hero-content h1 {
      font-size: 2.2rem;
    }

    .search-section {
      flex-direction: column;
      margin: -50px auto 40px;
    }

    .search-section button {
      margin-top: 15px;
      width: 100%;
    }

    .info-cards {
      gap: 18px;
    }



    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }


  }

  .features {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    padding: 60px 20px;
    background-color: #fff;
  }

  .feature-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    padding: 30px 20px;
    text-align: center;
    flex: 1 1 260px;
    max-width: 300px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(247, 148, 29, 0.2);
  }

  .feature-card img {
    height: 60px;
    margin-bottom: 20px;
    filter: grayscale(20%);
  }

  .feature-card h3 {
    color: #f7941d;
    font-size: 20px;
    margin-bottom: 10px;
  }

  .feature-card p {
    color: #555;
    font-size: 14px;
    line-height: 1.5;
  }
</style>

<body>
  <!-- Navbar (reuse your header.php navbar) -->

  <!-- Hero Section -->
  <section class="hero" role="banner" aria-label="Welcome section with rent a car message">
    <div class="hero-content">
      <h1>Rent Your Perfect Car in Prishtina</h1>
      <p>Affordable prices, great service, and a wide selection of vehicles to fit your needs.</p>
      <button class="btn-primary" onclick="window.location.href='register.php'">Get Started</button>
    </div>
  </section>

  <!-- Search Form -->
  <section class="search-section" aria-label="Search cars to rent">
    <form action="searchResults.php" method="GET" style="width: 100%; display: flex; flex-wrap: wrap; gap: 15px; justify-content: center;">
      <div class="form-group">
        <label for="pickup-location">Pickup Location</label>
        <select name="pickup-location" id="pickup-location" required>
          <option value="" disabled selected>Zgjidh Lokacionin</option>
          <option value="prishtina">Prishtina</option>
          <option value="ferizaj">Ferizaj</option>
          <option value="gjilan">Gjilan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="pickup-date">Pickup Date</label>
        <input type="date" name="pickup-date" id="pickup-date" required min="<?= date('Y-m-d') ?>">
      </div>
      <div class="form-group">
        <label for="return-date">Return Date</label>
        <input type="date" name="return-date" id="return-date" required min="<?= date('Y-m-d') ?>">
      </div>
      <div class="form-group">
        <label for="car-type">Car Type</label>
        <select name="car-type" id="car-type" required>
          <option value="" disabled selected>Zgjidh Tipin e Makinës</option>
          <option value="economy">Economy</option>
          <option value="standard">Standard</option>
          <option value="suv">SUV</option>
          <option value="luxury">Luxury</option>
        </select>
      </div>
      <a href="list_cars.php"><button type="button" aria-label="Search Cars">Kerko</button></a>
    </form>
  </section>

  <!-- Info Cards -->
  <section class="info-cards" aria-label="Why choose Rent A Car Diari">
    <article class="card" tabindex="0">
      <h3>Wide Vehicle Selection</h3>
      <p>Choose from a broad range of cars, from economy to luxury, perfect for any occasion.</p>
    </article>
    <article class="card" tabindex="0">
      <h3>Affordable Prices</h3>
      <p>Competitive pricing and transparent fees ensure you get the best deal every time.</p>
    </article>
  </section>
  </section> <!-- closes .info-cards -->

  <!-- Feature Cards Section -->
  <section class="features" aria-label="Our guarantees and services">
    <div class="feature-card">
      <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Best Price Icon" />
      <h3>Best Price Guarantee</h3>
      <p>We guarantee the lowest prices on all vehicles with no hidden fees.</p>
    </div>
    <div class="feature-card">
      <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" alt="24/7 Support Icon" />
      <h3>24/7 Support</h3>
      <p>Our team is available day and night to assist you anytime.</p>
    </div>
    <div class="feature-card">
      <img src="https://cdn-icons-png.flaticon.com/512/1034/1034124.png" alt="Full Insurance Icon" />
      <h3>Full Insurance</h3>
      <p>All our rentals include full insurance to keep you protected.</p>
    </div>
  </section>

  <?php include_once "footer.php"; ?>
</body>
<script>
  const cards = document.querySelectorAll('.card');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); // Optional: stop observing once visible
      }
    });
  }, {
    threshold: 0.2
  });

  cards.forEach(card => {
    observer.observe(card);
  });
</script>