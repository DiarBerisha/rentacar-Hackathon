<?php
session_start();
include_once "config.php";
include_once "header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['cancel_id'])) {
    $cancel_id = (int)$_GET['cancel_id'];
    try {
        $check = $conn->prepare("SELECT * FROM bookings WHERE id = :id AND customer_id = :user_id AND status = 'Pending'");
        $check->execute([':id' => $cancel_id, ':user_id' => $user_id]);
        if ($check->fetch()) {
            $stmt = $conn->prepare("DELETE FROM bookings WHERE id = :id");
            $stmt->execute([':id' => $cancel_id]);
            header("Location: user_dashboard.php?message=Booking+cancelled");
            exit;
        }
    } catch (PDOException $e) {
        die("Error cancelling booking: " . $e->getMessage());
    }
}

$filter = $_GET['filter'] ?? 'all';
$whereClause = "WHERE b.customer_id = :user_id";

if ($filter == 'upcoming') {
    $whereClause .= " AND b.pickup_date >= CURDATE()";
} elseif ($filter == 'past') {
    $whereClause .= " AND b.return_date < CURDATE()";
}

try {
    $sql = "
        SELECT b.id AS booking_id, b.pickup_date, b.return_date, b.status, c.brand, c.model, c.year
        FROM bookings b
        JOIN cars c ON b.car_id = c.id
        $whereClause
        ORDER BY b.pickup_date DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':user_id' => $user_id]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching bookings: " . $e->getMessage());
}
?>

<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    font-family: Arial, sans-serif;
    background: #f4f4f4;
}

.dashboard-container {
    flex: 1;
    max-width: 1000px;
    margin: 30px auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.dashboard-container h1 {
    color: #f7941d;
    text-align: center;
    margin-bottom: 20px;
}

.filters {
    text-align: center;
    margin-bottom: 20px;
}

.filters a {
    display: inline-block;
    margin: 0 8px;
    padding: 8px 16px;
    background: #f7941d;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s;
}

.filters a.active, .filters a:hover {
    background: #e67e22;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background: #f7941d;
    color: #111;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

.status-label {
    padding: 5px 8px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
}

.status-Accepted {
    background-color: #2ecc71;
    color: white;
}

.status-Pending {
    background-color: #f1c40f;
    color: black;
}

.cancel-btn {
    display: inline-block;
    padding: 6px 10px;
    background-color: #e74c3c;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    font-size: 13px;
}

.cancel-btn:hover {
    background-color: #c0392b;
}

.message {
    color: green;
    text-align: center;
    margin-bottom: 15px;
    font-weight: bold;
}

footer {
    background-color: #222;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    margin-top: auto;
}
</style>

<div class="dashboard-container">

    <h1>My Bookings</h1>

    <?php if (isset($_GET['message'])) : ?>
        <p class="message"><?= htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    

    <?php if (!empty($bookings)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['booking_id']); ?></td>
                        <td><?= htmlspecialchars($booking['brand'] . ' ' . $booking['model'] . ' (' . $booking['year'] . ')'); ?></td>
                        <td><?= htmlspecialchars($booking['pickup_date']); ?></td>
                        <td><?= htmlspecialchars($booking['return_date']); ?></td>
                        <td>
                            <span class="status-label status-<?= htmlspecialchars($booking['status'] ?? 'Pending'); ?>">
                                <?= htmlspecialchars($booking['status'] ?? 'Pending'); ?>
                            </span>
                        </td>
                        <td>
                            <?php if (($booking['status'] ?? 'Pending') === 'Pending') : ?>
                                <a class="cancel-btn" href="user_dashboard.php?cancel_id=<?= $booking['booking_id']; ?>" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</a>
                            <?php else : ?>
                                <em>—</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p style="text-align:center;">You have no bookings for this filter.</p>
    <?php endif; ?>

</div>

<?php include_once "footer.php"; ?>
