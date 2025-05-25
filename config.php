<?php
$host = 'localhost';       // your DB host (usually localhost)
$db   = 'rentacar';   // your database name
$user = 'root';   // your database username
$pass = '';   // your database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays by default
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation of prepared statements
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // You can log error or show friendly message here
    die('Database connection failed: ' . $e->getMessage());
}
