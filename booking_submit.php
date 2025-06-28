<?php
session_start();
include_once "config.php";

// Redirect to login if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Query bookings related to the current user
$stmt = $conn->prepare("
    SELECT b.id, b.pickup_date, b.return_date, c.brand, c.model, c.year
    FROM bookings b
    JOIN cars c ON b.car_id = c.id
    WHERE b.customer_id = :user_id
    ORDER BY b.pickup_date DESC
");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once "header.php";
?>

<style>
    body {
        background: #111;
        color: white;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .dashboard-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
    }
    h1 {
        color: #f7941d;
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 0 0 5px rgba(0,0,0,0.7);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: #222;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        border-radius: 8px;
        overflow: hidden;
    }
    th, td {
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
    p.no-bookings {
        text-align: center;
        font-size: 18px;
        margin-top: 50px;
        color: #ccc;
    }
</style>

<div class="dashboard-container">
    <h1>My Bookings</h1>

    <?php if ($bookings) : ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['id']) ?></td>
                        <td><?= htmlspecialchars($booking['brand'] . ' ' . $booking['model'] . ' (' . $booking['year'] . ')') ?></td>
                        <td><?= htmlspecialchars($booking['pickup_date']) ?></td>
                        <td><?= htmlspecialchars($booking['return_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="no-bookings">You have no bookings yet.</p>
    <?php endif; ?>
</div>

<?php include_once "footer.php"; ?>
