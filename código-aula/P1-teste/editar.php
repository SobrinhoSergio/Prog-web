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

echo "Editar Produto\n";

$id = readline("ID do produto a ser editado: ");

// Verificar se o ID fornecido é numérico e positivo
if (!is_numeric($id) || $id <= 0) {
    die("O ID precisa ser um número inteiro positivo.");
}

$descricao = readline("Nova descrição: ");
$preco = readline("Novo preço: ");
$quantidade = readline("Nova quantidade: ");

// Criar um novo objeto Produto com os dados atualizados
$produto = new Produto(null, $descricao, $preco, $quantidade);

try {
    // Chamar o método editar do RepositorioProduto
    $ok = $repositorioProduto->editar($id, $produto);

    if ($ok) {
        echo "Produto editado com sucesso!\n";
    } else {
        echo "Nenhum produto foi encontrado com o ID fornecido.\n";
    }
} catch (RepositorioException $e) {
    die("Erro ao editar produto: " . $e->getMessage());
}

?>
