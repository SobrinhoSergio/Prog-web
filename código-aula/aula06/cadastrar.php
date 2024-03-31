<?php

require_once 'conectar.php';

$descricao = readline("Descrição: ");
$estoque = readline("Estoque: ");
$preco = readline("Preço (R$): ");

$pdo = null;

try {
    
    $pdo = conectar();
    
    $ps = $pdo->prepare( 'INSERT INTO produto ( descricao, estoque, preco_compra )
                           VALUES ( :descricao, :estoque, :preco )' );
   
    $ps->execute( ['descricao' => $descricao, 'estoque' => $estoque, 'preco' => $preco ] );

    echo 'Inserido com sucesso.';

    
    
}catch(PDOException $e){
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}


/*$descricao = readline("Descrição: ");
$estoque = readline("Estoque: ");
$preco = readline("Preço (R$): ");

$contagem = $pdo->exec(
    "INSERT INTO produto (descricao, estoque, preco)
    VALUES ('$descricao', $estoque, $preco)"
);

echo $contagem === 1 ? 'Sucesso' : 'Erro';*/


?>