<?php

require_once 'conectar.php';

$pdo = null;

try {
    $pdo = conectar();

    $ps = $pdo->prepare("
        SELECT 
            SUM(estoque) AS somaEstoque, 
            MAX(preco_compra) AS maiorPreco,
            AVG(preco_compra) AS media_preco
        FROM produto
    ");

    $ps->setFetchMode(PDO::FETCH_ASSOC);
    $ps->execute();
    $dados = $ps->fetch();

    echo 'Somatório de estoque: ', $dados['somaEstoque'],
    '. Maior preço: ', $dados['maiorPreco'],
    '. Media preço: ', $dados['media_preco'];

}catch(PDOException $e){
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}

?>