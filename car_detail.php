<?php
include_once "config.php";
include_once "header.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid car ID.");
}

$car_id = (int)$_GET['id'];

// Fetch car details with PDO
try {
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->execute([$car_id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        die("Car not found.");
    }
} catch (PDOException $e) {
    die("Error fetching car: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Book <?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></title>
    <style>
        .main {
            font-family: Arial, sans-serif;
            background: #111;
            color: white;
            padding: 20px;
            max-width: 700px;
            margin: 40px auto;
        }

        h1 {
            color: #f7941d;
            margin-bottom: 15px;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);
        }

        .car-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 0 10px rgba(247, 148, 29, 0.6);
        }

        .details p {
            margin: 8px 0;
            font-size: 16px;
        }

        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input,
        button {
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #f7941d;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background: #f7941d;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #e88312;
        }
    </style>
</head>

<body>
        <section class="main">
    <img class="car-image" src="<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>">

    <h1>Book <?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']) ?> (<?= (int)$car['year'] ?>)</h1>

    <p><strong>Fuel:</strong> <?= htmlspecialchars($car['fuel_type']) ?></p>
    <p><strong>Transmission:</strong> <?= htmlspecialchars($car['transmission']) ?></p>
    <p><strong>Seats:</strong> <?= (int)$car['seats'] ?></p>
    <p><strong>Doors:</strong> <?= (int)$car['doors'] ?></p>
    <p><strong>Luggage:</strong> <?= (int)$car['luggage'] ?></p>
    <p><strong>Air Conditioning:</strong> <?= $car['air_conditioning'] ? 'Yes' : 'No' ?></p>
    <p><?= nl2br(htmlspecialchars($car['description'])) ?></p>
    <p><strong>Price per day:</strong> €<?= number_format($car['price_per_day'], 2) ?></p>

    <form action="booking_submit.php" method="POST">
        <input type="hidden" name="car_id" value="<?= $car['id'] ?>">

        <label for="name">Full Name*</label>
        <input type="text" name="name" id="name" required placeholder="Your full name">

        <label for="email">Email*</label>
        <input type="email" name="email" id="email" required placeholder="you@example.com">

        <label for="phone">Phone Number*</label>
        <input type="tel" name="phone" id="phone" required placeholder="+383 4X XXX XXX">

        <label for="pickup_date">Pickup Date*</label>
        <input type="date" name="pickup_date" id="pickup_date" required min="<?= date('Y-m-d') ?>">

        <label for="return_date">Return Date*</label>
        <input type="date" name="return_date" id="return_date" required min="<?= date('Y-m-d') ?>">

        <button type="submit">Book Now</button>
    </form>
</section>
</body>

</html>