<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
