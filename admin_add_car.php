<?php
session_start();
include_once "config.php";


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $brand = trim($_POST['brand'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $year = (int)($_POST['year'] ?? 0);
    $fuel_type = trim($_POST['fuel_type'] ?? '');
    $transmission = trim($_POST['transmission'] ?? '');
    $seats = (int)($_POST['seats'] ?? 0);
    $doors = (int)($_POST['doors'] ?? 0);
    $luggage = (int)($_POST['luggage'] ?? 0);
    $air_conditioning = isset($_POST['air_conditioning']) ? 1 : 0;
    $description = trim($_POST['description'] ?? '');
    $price_per_day = floatval($_POST['price_per_day'] ?? 0);
    $image_url = trim($_POST['image_url'] ?? '');

    
    if (!$brand || !$model || !$year || !$price_per_day) {
        $message = "Please fill in all required fields.";
    } else {
        try {
            $sql = "INSERT INTO cars 
                (brand, model, year, fuel_type, transmission, seats, doors, luggage, air_conditioning, description, price_per_day, image_url) 
                VALUES 
                (:brand, :model, :year, :fuel_type, :transmission, :seats, :doors, :luggage, :air_conditioning, :description, :price_per_day, :image_url)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':brand' => $brand,
                ':model' => $model,
                ':year' => $year,
                ':fuel_type' => $fuel_type,
                ':transmission' => $transmission,
                ':seats' => $seats,
                ':doors' => $doors,
                ':luggage' => $luggage,
                ':air_conditioning' => $air_conditioning,
                ':description' => $description,
                ':price_per_day' => $price_per_day,
                ':image_url' => $image_url,
            ]);
            $message = "Car added successfully!";
        } catch (PDOException $e) {
            $message = "Error adding car: " . $e->getMessage();
        }
    }
}
?>

<?php include_once "header.php"; ?>

<style>
    .add-car-form {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }
    .add-car-form h2 {
        color: #f7941d;
        text-align: center;
        margin-bottom: 20px;
    }
    .add-car-form label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
    }
    .add-car-form input[type=text],
    .add-car-form input[type=number],
    .add-car-form textarea {
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        border: 1.5px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
    }
    .add-car-form textarea {
        resize: vertical;
        height: 80px;
    }
    .add-car-form button {
        margin-top: 25px;
        width: 100%;
        padding: 15px;
        background-color: #f7941d;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 18px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .add-car-form button:hover {
        background-color: #e88312;
    }
    .message {
        text-align: center;
        margin-top: 15px;
        font-weight: bold;
        color: green;
    }
    .error {
        color: red;
    }
</style>

<div class="add-car-form">
    <h2>Add New Car</h2>

    <?php if ($message): ?>
        <p class="message <?= strpos($message, 'Error') === 0 ? 'error' : '' ?>"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="brand">Brand*</label>
        <input type="text" id="brand" name="brand" required>

        <label for="model">Model*</label>
        <input type="text" id="model" name="model" required>

        <label for="year">Year*</label>
        <input type="number" id="year" name="year" min="1900" max="<?= date('Y') + 1 ?>" required>

        <label for="fuel_type">Fuel Type</label>
        <input type="text" id="fuel_type" name="fuel_type" placeholder="e.g., Petrol, Diesel">

        <label for="transmission">Transmission</label>
        <input type="text" id="transmission" name="transmission" placeholder="e.g., Manual, Automatic">

        <label for="seats">Seats</label>
        <input type="number" id="seats" name="seats" min="1" max="20" value="4">

        <label for="doors">Doors</label>
        <input type="number" id="doors" name="doors" min="1" max="10" value="4">

        <label for="luggage">Luggage Capacity</label>
        <input type="number" id="luggage" name="luggage" min="0" max="20" value="2">

        <label for="air_conditioning">
            <input type="checkbox" id="air_conditioning" name="air_conditioning" value="1"> Air Conditioning
        </label>

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Car description..."></textarea>

        <label for="price_per_day">Price Per Day (€)*</label>
        <input type="number" step="0.01" id="price_per_day" name="price_per_day" min="0" required>

        <label for="image_url">Image URL</label>
        <input type="text" id="image_url" name="image_url" placeholder="Link to car image">

        <button type="submit">Add Car</button>
    </form>
</div>

<?php include_once "footer.php"; ?>
