<?php
include_once "config.php";
include_once "header.php";

// Fetch all cars
try {
    $stmt = $conn->query("SELECT * FROM cars");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gabim gjatë marrjes së të dhënave të makinave: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>All Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .car-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        a.car-link {
            text-decoration: none;
            color: inherit;
            width: 300px;
        }

        .car-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .car-card:hover {
            transform: scale(1.05);
        }

        .car-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .car-card .content {
            padding: 15px;
            flex-grow: 1;
        }

        .car-card h3 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .car-card p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .price {
            font-weight: bold;
            color: #f7941d;
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <h1 style="text-align:center;">Available Cars</h1>

    <div class="car-container">
        <?php if (!empty($cars)) : ?>
            <?php foreach ($cars as $car) : ?>
                <a class="car-link" href="car_detail.php?id=<?= (int)$car['id']; ?>">
                    <div class="car-card">
                        <img src="<?= htmlspecialchars($car['image_url']); ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                        <div class="content">
                            <h3><?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']) . ' (' . (int)$car['year'] . ')' ?></h3>
                            <p><strong>Fuel:</strong> <?= htmlspecialchars($car['fuel_type']); ?></p>
                            <p><strong>Transmission:</strong> <?= htmlspecialchars($car['transmission']); ?></p>
                            <p><strong>Seats:</strong> <?= (int)$car['seats']; ?></p>
                            <p><strong>Doors:</strong> <?= (int)$car['doors']; ?></p>
                            <p><strong>Luggage:</strong> <?= (int)$car['luggage']; ?></p>
                            <p><strong>Air Conditioning:</strong> <?= $car['air_conditioning'] ? 'Yes' : 'No'; ?></p>
                            <p><?= nl2br(htmlspecialchars($car['description'])); ?></p>
                            <span class="price">€<?= number_format($car['price_per_day'], 2); ?> / day</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No cars found.</p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php include_once "footer.php"; ?>