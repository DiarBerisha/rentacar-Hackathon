<?php
include_once "config.php"; // Contains $conn (PDO object)

// Optional: Add admin authentication here

try {
    $stmt = $conn->query("
        SELECT b.id, b.name, b.email, b.phone, b.pickup_date, b.return_date,
               c.brand, c.model, c.year
        FROM bookings b
        JOIN cars c ON b.car_id = c.id
        ORDER BY b.pickup_date DESC
    ");

    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching bookings: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin - Manage Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            background: #111;
            color: white;
            padding: 20px;
        }

        h1 {
            color: #f7941d;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #444;
            text-align: left;
        }

        th {
            background: #f7941d;
            color: #111;
            font-weight: 700;
        }

        tr:nth-child(even) {
            background: #333;
        }

        tr:hover {
            background: #444;
        }

        a {
            color: #f7941d;
            text-decoration: none;
            font-weight: 700;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>All Bookings</h1>

    <?php if (!empty($bookings)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car</th>
                    <th>Renter Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['id']) ?></td>
                        <td><?= htmlspecialchars($booking['brand'] . ' ' . $booking['model'] . ' (' . $booking['year'] . ')') ?></td>
                        <td><?= htmlspecialchars($booking['name']) ?></td>
                        <td><?= htmlspecialchars($booking['email']) ?></td>
                        <td><?= htmlspecialchars($booking['phone']) ?></td>
                        <td><?= htmlspecialchars($booking['pickup_date']) ?></td>
                        <td><?= htmlspecialchars($booking['return_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</body>

</html>