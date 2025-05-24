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
        VALUES(:email, :emri, :mbiemri,: ditlindja, :patentshoferi, :numritelefonit, :kodipostar,:qyteti,:shteti,:adresa,:title,:password,:confirm_password,:is_admin)";
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


?>