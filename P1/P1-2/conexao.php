<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_pessoas_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}