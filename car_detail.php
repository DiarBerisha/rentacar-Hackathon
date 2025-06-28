<?php
include_once "config.php";
include_once "header.php";

// Get car ID from URL, sanitize it
$car_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($car_id <= 0) {
    die("Invalid car ID.");
}

try {
    // Prepare and execute query
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
    $stmt->bindParam(':id', $car_id, PDO::PARAM_INT);
    $stmt->execute();

    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        die("Car not found.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<style>
  .container {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: Arial, sans-serif;
  }

  .car-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    padding: 30px;
  }

  .car-image {
    flex: 1 1 400px;
    max-width: 400px;
  }

  .car-image img {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
  }

  .car-info {
    flex: 1 1 400px;
    display: flex;
    flex-direction: column;
  }

  .car-info h1 {
    margin: 0 0 20px;
    color: #f7941d;
  }

  .car-info p {
    margin: 10px 0;
    color: #555;
    font-size: 16px;
  }

  .car-info .specs p {
    margin: 6px 0;
  }

  .price {
    font-size: 24px;
    font-weight: 700;
    color: #f7941d;
    margin: 25px 0;
  }

  .btn-book {
    background-color: #f7941d;
    border: none;
    padding: 15px 25px;
    color: white;
    font-weight: 700;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    max-width: 200px;
    transition: background-color 0.3s ease;
    text-align: center;
    text-decoration: none;
  }

  .btn-book:hover {
    background-color: #e88312;
  }

  @media (max-width: 768px) {
    .car-detail {
      flex-direction: column;
      align-items: center;
    }
    .car-image, .car-info {
      max-width: 100%;
      flex: none;
    }
  }
</style>

<div class="container">
  <div class="car-detail">
    <div class="car-image">
      <img src="<?= htmlspecialchars($car['image_url']); ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
    </div>

    <div class="car-info">
      <h1><?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']) . ' (' . (int)$car['year'] . ')'; ?></h1>
      <div class="specs">
        <p><strong>Fuel Type:</strong> <?= htmlspecialchars($car['fuel_type']); ?></p>
        <p><strong>Transmission:</strong> <?= htmlspecialchars($car['transmission']); ?></p>
        <p><strong>Seats:</strong> <?= (int)$car['seats']; ?></p>
        <p><strong>Doors:</strong> <?= (int)$car['doors']; ?></p>
        <p><strong>Luggage Capacity:</strong> <?= (int)$car['luggage']; ?></p>
        <p><strong>Air Conditioning:</strong> <?= $car['air_conditioning'] ? 'Yes' : 'No'; ?></p>
      </div>
      <p><?= nl2br(htmlspecialchars($car['description'])); ?></p>
      <div class="price">€<?= number_format($car['price_per_day'], 2); ?> / day</div>
      <a href="booking.php?car_id=<?= (int)$car['id']; ?>" class="btn-book">Book Now</a>
    </div>
  </div>
</div>

<?php include_once "footer.php"; ?>
