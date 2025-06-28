<?php
session_start();
include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Metoda e kërkesës nuk është e vlefshme.");
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    die("Ju lutem plotësoni emailin dhe fjalëkalimin.");
}

try {
    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        die("Email ose fjalëkalimi i gabuar.");
    }

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];


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
