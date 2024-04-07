<?php

require_once 'repositorio-produto-em-bdr.php';
require_once 'repositorio-exception.php';
require_once 'produto.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=provaP1;charset=utf8", 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(PDOException $e) {
    die("Erro ao conectar ao Banco de Dados: " . $e->getMessage());
}

$repositorioProduto = new RepositorioProdutoEmBdr($pdo);

echo "Cadastro de Produto\n";

$descricao = readline("Descrição: ");
$preco = readline("Preço: ");
$quantidade = readline("Quantidade: ");

// Criar um novo objeto Produto
$produto = new Produto(null, $descricao, $preco, $quantidade);

try {
    // Chamar o método cadastrar do RepositorioProduto
    $repositorioProduto->cadastrar($produto);
    echo "Produto cadastrado com sucesso!\n";
} catch (RepositorioException $e) {
    die("Erro ao cadastrar produto: " . $e->getMessage());
}

?>
