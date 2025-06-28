<?php
session_start();
include_once "config.php";

// ✅ Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = (int)$_POST['car_id'];
    $pickup_date = $_POST['pickup_date'] ?? '';
    $return_date = $_POST['return_date'] ?? '';

    // ✅ Simple date validation
    if (empty($pickup_date) || empty($return_date) || $return_date < $pickup_date) {
        die("Invalid booking dates.");
    }

    try {
        $stmt = $conn->prepare("
            INSERT INTO bookings (car_id, customer_id, pickup_date, return_date, status)
            VALUES (:car_id, :user_id, :pickup_date, :return_date, 'Pending')
        ");
        $stmt->execute([
            ':car_id' => $car_id,
            ':user_id' => $user_id,
            ':pickup_date' => $pickup_date,
            ':return_date' => $return_date
        ]);

        header("Location: user_dashboard.php?message=Booking+successful");
        exit;

    } catch (PDOException $e) {
        die("Error processing booking: " . $e->getMessage());
    }
} else {
    header("Location: list_cars.php");
    exit;
}
?>
