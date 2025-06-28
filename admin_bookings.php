<?php
session_start();
include_once "config.php";

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

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

try {
    $stmt = $conn->query("
        SELECT 
            b.id AS booking_id,
            u.emri AS name,
            u.email,
            u.numritelefonit AS phone,
            b.pickup_date,
            b.return_date,
            b.status,
            c.brand,
            c.model,
            c.year
        FROM bookings b
        JOIN users u ON b.customer_id = u.id
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        /* Reset & basics */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding-top: 100px;   /* for fixed navbar */
            padding-bottom: 140px; /* for fixed footer */
            font-family: Arial, sans-serif;
            background: #121212;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: black;
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0,0,0,0.7);
        }

        .logoimg {
            height: 75px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 8px;
            transition: background 0.3s;
        }

        .nav-links a:hover,
        .nav-links a:focus {
            background-color: #575757;
            border-radius: 4px;
            outline: none;
        }

        /* Main content wrapper */
        .content-wrapper {
            flex: 1 0 auto;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        h1 {
            color: #f7941d;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            overflow-x: auto;
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

        /* Buttons container below table */
        .buttons-container {
            margin-top: 20px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            background-color: #f7941d;
            color: #111;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
            text-align: center;
            min-width: 130px;
        }

        .btn:hover,
        .btn:focus {
            background-color: #e88312;
            outline: none;
        }

        /* Action buttons inside table */
        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            color: white;
        }

        .accept-btn {
            background-color: #2ecc71;
        }

        .reject-btn {
            background-color: #e74c3c;
        }

        /* Status labels */
        .status-label {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
        }

        .status-Accepted {
            background-color: #2ecc71;
            color: white;
        }

        .status-Pending {
            background-color: #f1c40f;
            color: black;
        }

        /* Footer */
        .site-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #222;
            color: #ddd;
            padding: 40px 20px 20px;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .footer-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1 1 250px;
            min-width: 220px;
        }

        .footer-section h3,
        .footer-section h4 {
            color: #f7941d;
            margin-bottom: 15px;
        }

        .footer-section p,
        .footer-section ul,
        .footer-section li {
            margin: 0;
            padding: 0;
            list-style: none;
            color: #ccc;
        }

        .footer-section ul {
            margin-top: 10px;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover,
        .footer-section ul li a:focus {
            color: #f7941d;
            outline: none;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            display: inline-block;
            margin-right: 10px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .social-icons a:hover,
        .social-icons a:focus {
            opacity: 1;
            outline: none;
        }

        .footer-bottom {
            text-align: center;
            padding: 20px 0 10px;
            color: #777;
            border-top: 1px solid #444;
            font-size: 13px;
            margin-top: 20px;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                gap: 30px;
            }
            .nav-links {
                flex-wrap: wrap;
            }
            .nav-links li {
                margin-left: 10px;
                margin-bottom: 8px;
            }
            .buttons-container {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" role="navigation" aria-label="Main Navigation">
        <div class="logo"><img src="RentLogo.PNG" class="logoimg" alt="Rent A Car Logo"></div>
        <ul class="nav-links">
            <li><a href="index.php">RENT A CAR</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li><a href="register.php">REGISTER</a></li>
            <li><a href="login.php">LOG IN</a></li>
        </ul>
    </nav>

    <main class="content-wrapper" role="main">
        <h1>All Bookings - Admin Panel</h1>

        <?php if (!empty($bookings)) : ?>
            <table aria-describedby="booking-list">
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

        <!-- Buttons below the table -->
        <div class="buttons-container">
            <a href="admin_add_car.php" class="btn" aria-label="Add New Car">+ Add New Car</a>
            <a href="logout.php" class="btn" aria-label="Logout">Logout</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer" role="contentinfo" aria-label="Footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>Rent A Car Diari</h3>
                <p>Your trusted car rental partner in Prishtina. Quality cars, great prices, and excellent service.</p>
            </div>
            <div class="footer-section links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="searchResults.php">Search Cars</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h4>Contact</h4>
                <p>Address: Rruga e Prishtinës, Prishtina, Kosovo</p>
                <p>Phone: +383 44 123 456</p>
                <p>Email: info@rentacar-diari.com</p>
                <div class="social-icons" aria-label="Social media links">
                    <a href="#" aria-label="Facebook" target="_blank" rel="noopener"><img src="https://cdn-icons-png.flaticon.com/24/733/733547.png" alt="Facebook"></a>
                    <a href="#" aria-label="Instagram" target="_blank" rel="noopener"><img src="https://cdn-icons-png.flaticon.com/24/2111/2111463.png" alt="Instagram"></a>
                    <a href="#" aria-label="Twitter" target="_blank" rel="noopener"><img src="https://cdn-icons-png.flaticon.com/24/733/733579.png" alt="Twitter"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?= date('Y') ?> Rent A Car Diari. All rights reserved.
        </div>
    </footer>

</body>
</html>
