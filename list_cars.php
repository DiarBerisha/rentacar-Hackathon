<?php
include_once "config.php";
include_once "header.php";

// Fetch all cars
try {
    $stmt = $conn->query("SELECT * FROM cars");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching cars: " . $e->getMessage());
}
?>

<style>
  body {
    background: #f4f4f4;
    font-family: Arial, sans-serif;
  }

  .container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
  }

  h1 {
    text-align: center;
    color: #f7941d;
    margin-bottom: 30px;
  }

  .car-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .car-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    width: 280px;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
  }

  .car-card:hover {
    transform: scale(1.05);
  }

  .car-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }

  .car-content {
    padding: 15px;
    flex-grow: 1;
  }

  .car-content h3 {
    margin: 0 0 10px;
    font-size: 1.2rem;
    color: #333;
  }

  .car-content p {
    margin: 5px 0;
    font-size: 14px;
    color: #555;
  }

  .price {
    font-weight: 700;
    color: #f7941d;
    margin-top: 10px;
    font-size: 16px;
  }
</style>

<div class="container">
  <h1>Available Cars</h1>
  <div class="car-grid">
    <?php if (!empty($cars)) : ?>
      <?php foreach ($cars as $car) : ?>
        <a href="car_detail.php?id=<?= (int)$car['id']; ?>" class="car-card" aria-label="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
          <img src="<?= htmlspecialchars($car['image_url']); ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
          <div class="car-content">
            <h3><?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']) . ' (' . (int)$car['year'] . ')'; ?></h3>
            <p><strong>Fuel:</strong> <?= htmlspecialchars($car['fuel_type']); ?></p>
            <p><strong>Transmission:</strong> <?= htmlspecialchars($car['transmission']); ?></p>
            <p class="price">€<?= number_format($car['price_per_day'], 2); ?> / day</p>
          </div>
        </a>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No cars available at the moment.</p>
    <?php endif; ?>
  </div>
</div>

<?php include_once "footer.php"; ?>
