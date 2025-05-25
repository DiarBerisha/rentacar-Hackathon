<?php
include_once "config.php";
include_once "header.php";

$today = date('Y-m-d');
$seventyYearsAgo = date('Y-m-d', strtotime('-70 years'));
?>

<style>
    /* Your CSS styles here (same as your original style block) */
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

    /* ... rest of your CSS here ... */

    .registration-form {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background: transparent;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        font-family: Arial, sans-serif;
    }

    /* Continue with your CSS as you had it */
</style>

<form class="registration-form" method="POST" action="registerLogic.php">
    <h2>Krijo Llogari</h2>
    <input type="email" name="email" placeholder="Email*" required>
    <input type="password" name="password" placeholder="Password*" required>
    <input type="password" name="confirm_password" placeholder="Confirm password*" required>

    <div class="form-section">
        <div class="form-column">
            <h2>Te dhënat e shoferit</h2>
            <select name="title" required>
                <option value="" hidden>Titulli</option>
                <option value="mr">Mr.</option>
                <option value="ms">Ms.</option>
                <option value="mrs">Mrs.</option>
                <option value="miss">Miss.</option>
                <option value="dr">Dr.</option>
                <option value="prof">Prof.</option>
            </select>
            <input type="text" name="emri" placeholder="Emri*" required>
            <input type="text" name="mbiemri" placeholder="Mbiemri*" required>
            <input class="data" type="date" name="birthday" min="<?= $seventyYearsAgo ?>" max="<?= $today ?>" required>
            <input type="text" name="patentshoferi" placeholder="Patentshoferi*" required>
        </div>

        <div class="form-column">
            <h2>Te dhënat kontaktuese</h2>
            <input type="text" name="numri-telefonit" placeholder="+383 4X XXX XXX*" required>
            <input type="text" name="adresa" placeholder="Adresa*" required>
            <input type="text" name="kodi-postar" placeholder="Kodi Postar*" required>
            <input type="text" name="qyteti" placeholder="Qyteti*" required>
            <input type="text" name="shteti" placeholder="Shteti*" required>
        </div>
    </div>

    <button type="submit">Regjistrohu</button>
</form>

<?php include_once "footer.php"; ?>