<?php

require_once 'conectar.php';

$id = readline("ID do produto a ser editado: ");

if (!is_numeric($id)) {
    die("O ID deve ser um número.");
}

$descricao = readline("Nova descrição: ");
$estoque = readline("Novo estoque: ");
$preco = readline("Novo preço (R$): ");

// Validações...

$pdo = null;

try {
    $pdo = conectar();

    $ps = $pdo->prepare('UPDATE produto SET descricao = :descricao, estoque = :estoque, preco_compra = :preco WHERE id = :id');

    $ps->execute(['id' => $id, 'descricao' => $descricao, 'estoque' => $estoque, 'preco' => $preco]);

    if ($ps->rowCount() > 0) {
        echo 'Produto editado com sucesso.';
    } else {
        echo 'Nenhum produto encontrado com o ID fornecido.';
    }
    
} catch(PDOException $e) {
    die("Erro ao consultar o banco de dados: " . $e->getMessage());
}
?>
