<?php
include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form inputs
  $email = $_POST['email'];
  $emri = $_POST['emri'];
  $mbiemri = $_POST['mbiemri'];
  $ditlindja = $_POST['birthday'];
  $patentshoferi = $_POST['patentshoferi'];
  $numritelefonit = $_POST['numri-telefonit'];
  $kodipostar = $_POST['kodi-postar'];
  $qyteti = $_POST['qyteti'];
  $shteti = $_POST['shteti'];
  $adresa = $_POST['adresa'];
  $title = $_POST['title'];
  $tempPass = $_POST['password'];
  $tempConfirm = $_POST['confirm_password'];

  // Check for empty fields
  if (
    empty($email) || empty($tempPass) || empty($tempConfirm) || empty($emri) ||
    empty($mbiemri) || empty($ditlindja) || empty($patentshoferi) || empty($numritelefonit) ||
    empty($kodipostar) || empty($qyteti) || empty($shteti) || empty($adresa) || empty($title)
  ) {
    echo "Ju lutemi plotësoni të gjitha fushat!";
    exit;
  }

  // Check if passwords match
  if ($tempPass !== $tempConfirm) {
    echo "Fjalëkalimet nuk përputhen!";
    exit;
  }

  // Hash password
  $password = password_hash($tempPass, PASSWORD_DEFAULT);
  $is_admin = 0;

  // Check if email already exists
  $checkSql = "SELECT id FROM users WHERE email = :email";
  $checkStmt = $conn->prepare($checkSql);
  $checkStmt->bindParam(':email', $email);
  $checkStmt->execute();

  if ($checkStmt->rowCount() > 0) {
    echo "Ky email është përdorur tashmë!";
    exit;
  }

  // Insert new user
  $sql = "INSERT INTO users (
                email, emri, mbiemri, ditlindja, patentshoferi, numritelefonit,
                kodipostar, qyteti, shteti, adresa, title, password, is_admin
            ) VALUES (
                :email, :emri, :mbiemri, :ditlindja, :patentshoferi, :numritelefonit,
                :kodipostar, :qyteti, :shteti, :adresa, :title, :password, :is_admin
            )";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':emri', $emri);
  $stmt->bindParam(':mbiemri', $mbiemri);
  $stmt->bindParam(':ditlindja', $ditlindja);
  $stmt->bindParam(':patentshoferi', $patentshoferi);
  $stmt->bindParam(':numritelefonit', $numritelefonit);
  $stmt->bindParam(':kodipostar', $kodipostar);
  $stmt->bindParam(':qyteti', $qyteti);
  $stmt->bindParam(':shteti', $shteti);
  $stmt->bindParam(':adresa', $adresa);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);

  if ($stmt->execute()) {
    session_start();
    $_SESSION['user_email'] = $email;  // You can store more user info if needed

    header("Location: user_dashboard.php");
    exit;
  } else {
    echo "Dështoi regjistrimi. Ju lutemi provoni përsëri.";
  }
}
