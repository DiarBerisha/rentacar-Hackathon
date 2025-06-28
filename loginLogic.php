<?php
session_start();
include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Metoda e kërkesës nuk është e vlefshme.");
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validate inputs
if (empty($email) || empty($password)) {
    die("Ju lutem plotësoni emailin dhe fjalëkalimin.");
}

try {
    // Fetch user by email
    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify user exists and password is correct
    if (!$user || !password_verify($password, $user['password'])) {
        die("Email ose fjalëkalimi i gabuar.");
    }

    // Regenerate session ID for security
    session_regenerate_id(true);

    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    // List of admin emails - add your admin emails here:
    $adminEmails = ['admin@yourdomain.com', 'boss@yourdomain.com'];

    if (in_array(strtolower($user['email']), $adminEmails)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_bookings.php");
        exit;
    } else {
        $_SESSION['admin_logged_in'] = false;
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Gabim në hyrje: " . $e->getMessage());
}
