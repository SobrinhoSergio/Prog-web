<?php

require_once 'conexao.php';

$pdo = null;

try {

    $pdo = conectar();

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