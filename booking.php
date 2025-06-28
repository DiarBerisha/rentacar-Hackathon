<?php
session_start();
include_once "config.php";
include_once "header.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$car_id = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
if ($car_id <= 0) {
    die("Invalid car ID.");
}

try {
    $stmt = $conn->prepare("SELECT brand, model, year, price_per_day FROM cars WHERE id = :id");
    $stmt->bindParam(':id', $car_id, PDO::PARAM_INT);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        die("Car not found.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$today = date('Y-m-d');
?>

<style>
  header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 60px; 
    background-color: #f7941d;
    color: white;
    padding: 15px 30px;
    box-sizing: border-box;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    z-index: 1000;
  }

  body {
    margin: 0;
    padding-top: 60px; 
    font-family: Arial, sans-serif;
    background: #f4f4f4;
  }

  .page-wrapper {
    min-height: calc(100vh - 60px); 
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

 
  .booking-container {
    width: 100%;
    max-width: 500px;
    background: white;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    box-sizing: border-box;
  }

  .booking-container h2 {
    color: #f7941d;
    margin-bottom: 20px;
    text-align: center;
  }

  label {
    display: block;
    margin: 15px 0 5px;
    font-weight: 600;
  }

  input[type="date"] {
    width: 100%;
    padding: 10px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
  }

  button {
    background-color: #f7941d;
    border: none;
    color: white;
    padding: 15px 0;
    width: 100%;
    border-radius: 8px;
    font-weight: 700;
    font-size: 18px;
    margin-top: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  html, body {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

  button:hover {
    background-color: #e88312;
  }
</style>

<div class="page-wrapper">
  <div class="booking-container">
    <h2>Book <?= htmlspecialchars($car['brand'] . ' ' . $car['model'] . ' (' . $car['year'] . ')'); ?></h2>
    <p style="text-align:center;">Price per day: €<?= number_format($car['price_per_day'], 2); ?></p>

    <form action="bookingLogic.php" method="POST">
      <input type="hidden" name="car_id" value="<?= $car_id; ?>">

      <label for="pickup_date">Pickup Date</label>
      <input type="date" id="pickup_date" name="pickup_date" min="<?= $today; ?>" required>

      <label for="return_date">Return Date</label>
      <input type="date" id="return_date" name="return_date" min="<?= $today; ?>" required>

      <button type="submit">Confirm Booking</button>
    </form>
  </div>
</div>

<?php include_once "footer.php"; ?>
