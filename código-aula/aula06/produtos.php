<?php

require_once 'conectar.php';

$pdo = null;

try {

    $pdo = conectar();

    $ps = $pdo->prepare("SELECT * FROM produto");
    $ps->setFetchMode(PDO::FETCH_ASSOC); 
    $ps->execute();

    foreach ($ps as $p) {
        echo '<p>' . $p['id'] . '-' . $p['descricao'] . '-' . $p['estoque'] . '-' . $p['preco_compra'] . '</p>';
    }
    
}catch(PDOException $e){
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}


?>