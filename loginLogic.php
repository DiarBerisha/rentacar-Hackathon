<?php

session_start();

include_once 'config.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please fill all the fields";
    } else {
        $sql = "SELECT id, email, emri, mbiemri, ditlindja, patentshoferi, numritelefonit, kodipostar, qyteti, shteti, adresa, title, password, confirm_password, is_admin
         FROM users WHERE email= :email";
        $selectUser = $conn->prepare($sql);
        $selectUser->bindParam(":email", $email);

        $selectUser->execute();

        $data = $selectUser->fetch();
        if ($data == false) {
            echo "The user does not exist";
        } else {
            if (password_verify($password, $data["password"])) {
                session_start();
                $_SESSION['mbiemri'] = $data['mbiemri'];
                $_SESSION['ditlindja'] = $data['ditlindja'];
                $_SESSION['numritelefonit'] = $data['numritelefonit'];
                $_SESSION['patentshoferi'] = $data['patentshoferi'];
                $_SESSION['ikodipostard'] = $data['kodipostar'];
                $_SESSION['qyteti'] = $data['qyteti'];
                $_SESSION['shteti'] = $data['shteti'];
                $_SESSION['adresa'] = $data['adresa'];
                $_SESSION['title'] = $data['title'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['confirm_password'] = $data['confirm_password'];
                $_SESSION['emri'] = $data['emri'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['is_admin'] = $data['is_admin'];

                header("Location: index.php");
            } else {
                echo 'Password is not valid';
            }
        }
    }
}
