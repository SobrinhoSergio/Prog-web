<?php

require_once 'conectar.php';

$descricao = readline("Descrição: ");
$estoque = readline("Estoque: ");
$preco = readline("Preço (R$): ");

// Validar a descrição
if (strlen($descricao) < 2 || strlen($descricao) > 100) {
    die("A descrição deve ter entre 2 e 100 caracteres.");
}

// Validar o estoque
if (!is_numeric($estoque) || $estoque < 0) {
    die("Estoque deve ser um número positivo.");
}

// Validar o preço
if (!is_numeric($preco) || $preco <= 0) {
    die("Preço deve ser um número positivo maior que zero.");
}

$pdo = null;

try {
    
    $pdo = conectar();
    
    $ps = $pdo->prepare( 'INSERT INTO produto (descricao, estoque, preco_compra)
                           VALUES (:descricao, :estoque, :preco)' );
   
    $ps->execute(['descricao' => $descricao, 'estoque' => $estoque, 'preco' => $preco]);

    echo 'Inserido com sucesso.';
    
} catch(PDOException $e) {
    die("Erro ao consultar o banco de dados: " . $e->getMessage());
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