<?php
include_once "config.php";
include_once "header.php";

$today = date('Y-m-d');
$seventyYearsAgo = date('Y-m-d', strtotime('-70 years'));
?>

<style>
    body {
        background-image: url('https://www.mbusa.com/content/dam/mb-nafta/us/myco/my25/gls-class/gls-suv/gallery/series/gallery-class/2025-GLS-SUV-GAL-002-K-FE-DR.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }


    .registration-form{
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background: transparent;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        font-family: Arial, sans-serif;
    }
    .registration-form input, .regbtn{
        max-width: 900px;
        padding: 10px 12px;
    font-size: 16px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    min-width: 140px;
    transition: border-color 0.3s ease;
    }
.regbtn{
    margin-top: 10px;
background-color: white;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: gray;
    font-size: 19px;
}

</style>

<form class="registration-form" method="POST" action="registerLogic.php">
    <h2>Krijo Llogari</h2>
    <input type="email" name="email" placeholder="Email*" required>
    <input type="password" name="password" placeholder="Password*" required>
    <input type="password" name="confirm_password" placeholder="Confirm password*" required>

    <div class="form-section">
        <div class="form-column">
            <h2>Te dhënat e shoferit</h2>
            
            <input type="text" name="emri" placeholder="Emri*" required>
            <input type="text" name="mbiemri" placeholder="Mbiemri*" required>
            <input class="data" type="date" name="birthday" min="<?= $seventyYearsAgo ?>" max="<?= $today ?>" required>
            <input type="text" name="patentshoferi" placeholder="Patentshoferi*" required>
        </div>

        <div class="form-column">
            <h2>Te dhënat kontaktuese</h2>
            <input type="text" name="numri-telefonit" placeholder="+383 4X XXX XXX*" required>
            <input type="text" name="adresa" placeholder="Adresa*" required>
            
            <input type="text" name="qyteti" placeholder="Qyteti*" required>
            <input type="text" name="shteti" placeholder="Shteti*" required>
        </div>
    </div>

    <button type="submit" class="regbtn">Regjistrohu</button>
</form>

<?php include_once "footer.php"; ?>