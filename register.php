<?php include_once "config.php";
include_once "header.php"; ?>
<form  method="POST" action="registerLogic.php">
<div class="create-account">
    <h2>Krijo Llogari</h2>
    <input type="email" name="email" placeholder="Email*">
    <input type="password" name="passowrd" placeholder="Password*">
    <input type="password" name="confirm_password" placeholder="Confirm password*">
</div>
<div class="wrapper">
    <div class="drivers-data">
        <h2>Te dhenat e shoferit</h2>
        <select name="title" class="title">
            <option hidden="">Titulli</option>
            <option value="mr">Mr.</option>
            <option value="ms">Ms.</option>
            <option value="mrs">Mrs.</option>
            <option value="miss">Miss.</option>
            <option value="dr">Dr.</option>
            <option value="prof">Prof.</option>
        </select>
        <input type="text" name="emri" placeholder="Emri*">
        <input type="text" name="mbiemri" placeholder="Mbiemri*">
        <input type="text" name="ditlindja" placeholder="Datelindja*">
        <input type="text" name="patentshoferi" placeholder="Patentshoferi*">


    </div>
    <div class="contact-details">
        <h2>Te dhemat kontaktuese</h2>
        <input type="text" name="numri-telefonit" placeholder="+383 4X XXX XXX">
        <input type="text" name="adresa" placeholder="Adresa*">
        <input type="text" name="kodi-postar" placeholder="Kodi Postar*">
        <input type="text" name="qyteti" placeholder="Qyteti*">
        <input type="text" name="shteti" placeholder="Shteti*">
    </div>
    <button type="submit" class="butoni">Regjistrohu</button>
</div>








</form>



<?php include_once "footer.php"; ?>