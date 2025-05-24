<?php

session_start();

$user = "root";
$pass = "";
$server = "localhost";
$dbname = "rentacar";

try{
    $conn = new PDO("mysql:host=$server;
    dbname=$dbname", $user, $pass);
} catch(PDOExeption $e){
    echo "Error: " . $e->getMessage();
}