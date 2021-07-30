<?php
session_start();
global $pdo;
try{
    $pdo = new PDO("mysql:dbname=shop;host=localhost","root","");
}catch(PDOException $e){
    echo "Falhou".$e->getMessage();
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
global $conn;
$conn = new mysqli($servername, $username, $password);


?>

