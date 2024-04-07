<?php

require_once 'repositorio-produto-em-bdr.php';
require_once 'repositorio-exception.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=provaP1;charset=utf8", 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(PDOException $e) {
    die("Erro ao conectar ao Banco de Dados: " . $e->getMessage());
}

$repositorioProduto = new RepositorioProdutoEmBdr($pdo);

try {
    $produtos = $repositorioProduto->listar();

    echo "Lista de Produtos:\n";
    foreach ($produtos as $produto) {
        echo "ID: " . $produto->getId() . ", Descrição: " . $produto->getDescricao() . ", Preço: " . $produto->getPreco() . ", Quantidade: " . $produto->getQuantidade() . "\n";
    }
} catch (RepositorioException $e) {
    die("Erro ao listar produtos: " . $e->getMessage());
}

?>
