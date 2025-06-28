<?php
session_start();
include_once "config.php";

// ✅ Only admin allowed
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// ✅ Handle Accept
if (isset($_GET['accept_id'])) {
    $accept_id = (int)$_GET['accept_id'];
    try {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Accepted' WHERE id = :id");
        $stmt->bindParam(':id', $accept_id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: admin_bookings.php");
        exit;
    } catch (PDOException $e) {
        die("Error accepting booking: " . $e->getMessage());
    }
}

// ✅ Handle Reject (Delete)
if (isset($_GET['reject_id'])) {
    $reject_id = (int)$_GET['reject_id'];
    try {
        $stmt = $conn->prepare("DELETE FROM bookings WHERE id = :id");
        $stmt->bindParam(':id', $reject_id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: admin_bookings.php");
        exit;
    } catch (PDOException $e) {
        die("Error rejecting booking: " . $e->getMessage());
    }
}

// ✅ Fetch all bookings
try {
    $stmt = $conn->query("
        SELECT 
            b.id AS booking_id,
            b.name,
            b.email,
            b.phone,
            b.pickup_date,
            b.return_date,
            b.status,
            c.brand,
            c.model,
            c.year
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
            background: #121212;
            color: white;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #f7941d;
            text-align: center;
            margin-bottom: 30px;
        }

        .add-car-btn {
            background-color: #f7941d;
            color: #111;
            padding: 12px 22px;
            border-radius: 6px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
            text-align: center;
        }
        .add-car-btn:hover {
            background-color: #e88312;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #333;
            text-align: left;
        }

        th {
            background-color: #f7941d;
            color: #111;
        }

        tr:nth-child(even) {
            background-color: #2c2c2c;
        }

        tr:hover {
            background-color: #444;
        }

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .accept-btn {
            background-color: #2ecc71;
            color: white;
        }

        .reject-btn {
            background-color: #e74c3c;
            color: white;
        }

        .status-label {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
        }

        .status-Accepted {
            background-color: #2ecc71;
            color: white;
        }

        .status-Pending {
            background-color: #f1c40f;
            color: black;
        }

        .logout-btn {
            background: #f7941d;
            color: #111;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <a class="logout-btn" href="logout.php">Logout</a>

    <!-- Add New Car Button -->
    <div style="text-align: center;">
      <a href="admin_add_car.php" class="add-car-btn">+ Add New Car</a>
    </div>

    <h1>All Bookings - Admin Panel</h1>

    <?php if (!empty($bookings)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Pickup</th>
                    <th>Return</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['booking_id']); ?></td>
                        <td><?= htmlspecialchars($booking['brand'] . ' ' . $booking['model'] . ' (' . $booking['year'] . ')'); ?></td>
                        <td><?= htmlspecialchars($booking['name']); ?></td>
                        <td><?= htmlspecialchars($booking['email']); ?></td>
                        <td><?= htmlspecialchars($booking['phone']); ?></td>
                        <td><?= htmlspecialchars($booking['pickup_date']); ?></td>
                        <td><?= htmlspecialchars($booking['return_date']); ?></td>
                        <td>
                            <span class="status-label status-<?= htmlspecialchars($booking['status'] ?? 'Pending'); ?>">
                                <?= htmlspecialchars($booking['status'] ?? 'Pending'); ?>
                            </span>
                        </td>
                        <td>
                            <?php if (($booking['status'] ?? 'Pending') !== 'Accepted') : ?>
                                <a class="action-btn accept-btn" href="admin_bookings.php?accept_id=<?= $booking['booking_id']; ?>">Accept</a>
                                <a class="action-btn reject-btn" href="admin_bookings.php?reject_id=<?= $booking['booking_id']; ?>" onclick="return confirm('Are you sure you want to reject (delete) this booking?');">Reject</a>
                            <?php else : ?>
                                <em>Accepted</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No bookings found.</p>
    <?php endif; ?>

</body>
</html>
