<?php include_once "config.php"; 


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $ditlindja = $_POST['ditlindja'];
    $patentshoferi = $_POST['patentshoferi'];
    $numritelefonit = $_POST['numri-telefonit'];
    $kodipostar = $_POST['kodi-postar'];
    $qyteti = $_POST['qyteti'];
    $shteti = $_POST['shteti'];
    $adresa = $_POST['adresa'];
    $title = $_POST['title'];
    $tempPass = $_POST['password'];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);
    $tempConfirm = $_POST['confirm_password'];
    $confirm_password = password_hash($tempPass, PASSWORD_DEFAULT);

    if (empty($email) || empty($tempPass)|| empty($confirm_password)||empty($emri) ||empty($mbiemri) ||empty($ditlindja) ||empty($patentshoferi) ||empty($numritelefonit) ||
    empty($kodipostar) ||empty($qyteti) ||empty($shteti) ||empty($adresa) ||empty($title)){
        echo "Plotësoni të gjitha fushat!";
    }else{
        $sql = "INSERT INTO users(email, emri, mbiemri, ditlindja, patentshoferi, numritelefonit, kodipostar, qyteti, shteti, adresa, title, password, confirm_password, is_admin) 
        VALUES(:email, :emri, :mbiemri,: ditlindja, :patentshoferi, :numritelefonit, :kodipostar, :qyteti, :shteti, :adresa, :title, :password, :confirm_password, :is_admin)";
        $insertSql = $conn->prepare($sql);

        $is_admin = 0;
        $insertSql->bindParam(":email", $email);
        $insertSql->bindParam(":emri", $emri);
        $insertSql->bindParam(":mbiemri", $mbiemri);
        $insertSql->bindParam(":ditlindja", $ditlindja);
        $insertSql->bindParam(":patentshoferi", $patentshoferi);
        $insertSql->bindParam(":numritelefonit", $numritelefonit);
        $insertSql->bindParam(":kodipostar", $kodipostar);
        $insertSql->bindParam(":qyteti", $qyteti);
        $insertSql->bindParam(":shteti", $shteti);
        $insertSql->bindParam(":adresa", $adresa);
        $insertSql->bindParam(":title", $title);
        $insertSql->bindParam(":confirm_password", $confirm_password);
        $insertSql->bindParam(":is_admin", $is_admin);

        $insertSql->execute();
        header("Location: login.php");
    }





}


?><?php
$today = date('Y-m-d');
$seventyYearsAgo = date('Y-m-d', strtotime('-70 years'));
$selected = $_GET['birthday'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Birthday Picker</title>
  <style>
    /* Hide the placeholder text on supported browsers */
    input[type="date"]::placeholder {
      color: transparent;
    }

    /* Optional: Minimal styling */
    input[type="date"] {
      font-size: 16px;
      padding: 5px;
    }
  </style>
  <script>
    function submitOnSelect(input) {
      if (input.value) {
        window.location.href = "?birthday=" + input.value;
      }
    }
  </script>
</head>
<body>
  <h2>Select Your Birthday</h2>

  <input
    type="date"
    id="birthday"
    name="birthday"
    min="<?= $seventyYearsAgo ?>"
    max="<?= $today ?>"
    onclick="this.showPicker()"
    onchange="submitOnSelect(this)"
    required
  >

  <?php if ($selected): ?>
    <p>You selected: <strong><?= htmlspecialchars($selected) ?></strong></p>
  <?php endif; ?>
</body>
</html>
