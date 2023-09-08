<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_pessoas_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para listar todos os lutadores
    $ps = $pdo->prepare("SELECT * FROM lutador");
    $ps->setFetchMode(PDO::FETCH_ASSOC); 
    $ps->execute();

    foreach ($ps as $p) {
        echo '<p>' . $p['id'] . '-' . $p['nome'] . '-' . $p['peso'] . '-' . $p['altura'] . '</p>';
    }
    
}catch(PDOException $e){
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}


?>