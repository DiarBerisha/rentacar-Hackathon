<?php
include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit;
}

// Sanitize and fetch POST data
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$emri = trim($_POST['emri'] ?? '');
$mbiemri = trim($_POST['mbiemri'] ?? '');
$birthday = $_POST['birthday'] ?? '';
$patentshoferi = trim($_POST['patentshoferi'] ?? '');
$numri_telefonit = trim($_POST['numri_telefonit'] ?? '');
$adresa = trim($_POST['adresa'] ?? '');
$qyteti = trim($_POST['qyteti'] ?? '');
$shteti = trim($_POST['shteti'] ?? '');

// Basic validations
if (empty($email) || empty($password) || empty($confirm_password) || empty($emri) || empty($mbiemri) || empty($birthday) || empty($patentshoferi) || empty($numri_telefonit) || empty($adresa) || empty($qyteti) || empty($shteti)) {
    die("Ju lutem plotësoni të gjitha fushat.");
}

if ($password !== $confirm_password) {
    die("Fjalëkalimet nuk përputhen.");
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
$stmt->execute([':email' => $email]);
if ($stmt->fetch()) {
    die("Email-i është përdorur tashmë.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (email, password, emri, mbiemri, ditlindja, patentshoferi, numritelefonit, adresa, qyteti, shteti) 
        VALUES (:email, :password, :emri, :mbiemri, :ditlindja, :patentshoferi, :numritelefonit, :adresa, :qyteti, :shteti)";
$stmt = $conn->prepare($sql);

try {
    $stmt->execute([
        ':email' => $email,
        ':password' => $hashed_password,
        ':emri' => $emri,
        ':mbiemri' => $mbiemri,
        ':ditlindja' => $birthday,
        ':patentshoferi' => $patentshoferi,
        ':numritelefonit' => $numri_telefonit,
        ':adresa' => $adresa,
        ':qyteti' => $qyteti,
        ':shteti' => $shteti,
    ]);
    // Redirect to login after successful registration
    header("Location: login.php");
    exit;
} catch (PDOException $e) {
    die("Gabim në regjistrim: " . $e->getMessage());
}
