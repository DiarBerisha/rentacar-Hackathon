<?php
include_once "config.php";
include_once "header.php";

// PHP date range for birthday
$today = date('Y-m-d');
$seventyYearsAgo = date('Y-m-d', strtotime('-70 years'));
?>

<style>
    body {
        /* Background image settings */
        background-image: url('https://images.hgmsites.net/hug/2020-bmw-x5-series_100728662_h.jpg');
        /* Replace with your image URL */
        background-size: cover;
        /* Makes image cover entire background */
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        background-attachment: fixed;
        /* Optional: keeps background fixed on scroll */
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .registration-form {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background: transparent;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }


    .registration-form h2 {
        color: #f7941d;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .form-section {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }


    .form-column {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-direction: column;
    }

    .form-column select {
        width: 457px;
        height: 38px;
    }

    .registration-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }

    .registration-form input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .registration-form input,
    .registration-form select {
        margin-bottom: 15px;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #f7941d;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.8);
        /* semi-transparent white */
        color: #333;
        width: 100%;
    }

    .registration-form input::placeholder {
        color: #666;
    }


    .registration-form input[type="date"]::placeholder {
        color: transparent;
    }

    .registration-form input[type="date"] {
        cursor: pointer;
    }

    .registration-form button {
        background: #f7941d;
        color: #fff;
        font-size: 16px;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin: 20px auto 0;
        display: block;
        width: 200px;
    }

    .data {
        height: 16px;
    }

    .registration-form button:hover {
        background: #e88312;
    }


    .registration-form button:hover {
        background: #e88312;
    }

    .registration-form h2 {
        color: white;
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);
    }

    .registration-form button {
        background: #f7941dcc;
        /* semi-transparent orange */
        border: none;
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        width: 200px;
        margin: 20px auto 0;
        display: block;
        font-weight: 700;
        transition: background 0.3s ease;
    }

    .registration-form button:hover {
        background: #e88312cc;
    }
</style>

<form class="registration-form" method="POST" action="registerLogic.php">
    <h2>Krijo Llogari</h2>
    <input type="email" name="email" placeholder="Email*" required>
    <input type="password" name="password" placeholder="Password*" required>
    <input type="password" name="confirm_password" placeholder="Confirm password*" required>

    <div class="form-section">
        <!-- Driver Details -->
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
            <input class="data" type="date" name="birthday" min="<?= $seventyYearsAgo ?>" max="<?= $today ?>" onclick="this.showPicker()" required>
            <input type="text" name="patentshoferi" placeholder="Patentshoferi*" required>
        </div>

        <!-- Contact Details -->
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