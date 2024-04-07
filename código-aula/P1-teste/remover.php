<?php

require_once 'repositorio-produto-em-bdr.php';
require_once 'repositorio-exception.php';

try{
    $pdo = new PDO("mysql:host=localhost;dbname=provaP1;charset=utf8", 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(PDOException $e){
    die("Erro ao conectar ao Banco de Dados: " . $e->getMessage());
}

$repositorioProduto = new RepositorioProdutoEmBdr($pdo);

echo "Digite dois ids para excluí-los: ";

$id1 = readline("");
$id2 = readline("");

if(!is_numeric($id1) || $id1<0){
    die("O Id1 precisa ser numérico!");
}

if(!is_numeric($id2) || $id2<0){
    die("O Id2 precisa ser numérico!");
}

try{
    $pdo->beginTransaction();
    $ok = $repositorioProduto->deletar($id1);

    if(!$ok){
        $pdo->roolback();
        return;
    }

    $ok = $repositorioProduto->deletar($id2);

    if(!ok){
        $pdo->rollback();
        return;
    }

    $pdo->commit();
}catch(RepositorioException $e){
    $pdo->roolback();
    die($e->getMessage());
}