<?php

function conectar(){
    return new PDO(
        "mysql:host=localhost;dbname=CRUD_P1;charset=utf8",
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
    );
}

// CADASTRAR.PHP

$descricao = readline("Digite uma descrição: ");
$preco = readline("Digite um preço: ");
$quantidade = readline("Digite uma quantidade: ");

$tamanhoDescricao = mb_strlen($descricao);

if(empty($descricao) || $tamanhoDescricao <= 0 || $tamanhoDescricao > 100){
    die("Descrição inválida");
}

if(!is_numeric($preco) || $preco <= 0.0){
    die("Preço inválido!");
}

if(!is_numeric($quantidade) || $quantidade < 0){
    die("Quantidade inválido!");
}

$pdo = null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare("INSERT INTO produto (descricao, preco, quantidade) VALUES (:descricao, :preco, :quantidade)");

    $ps->execute([
        'descricao' => $descricao,
        'preco' => $preco,
        'quantidade' => $quantidade
    ]);

    echo "Cadastrado com Sucesso!";

}catch(PDOException $e){
    die("Erro ao cadastrar: ".$e->getMessage());
}

// Editar

$id = readline("Digite o ID que deseja editar: ");

$descricaoNovo = readline("Digite uma descrição: ");
$precoNovo = readline("Digite um preço: ");
$quantidadeNovo = readline("Digite uma quantidade: ");

try{
    $pdo = conectar();

    $ps = $pdo->prepare("UPDATE produto SET descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id");

    $ps->execute([
        'id' => $id,
        'descricao' => $descricaoNovo,
        'preco' => $precoNovo,
        'quantidade' => $quantidadeNovo
    ]);

    if($ps->rowCount() < 1){
        echo "Produto não encontrado!";
    }
    else{
        echo "Produto editado com SUCESSO!";
    }

}catch(PDOException $e){
    die("Erro ao editar: ".$e->getMessage());
}

// Remover

try{
    $pdo = conectar();

    $ps = $pdo->prepare("DELETE FROM produto WHERE id = :id");

    $ps->execute(['id' => $id]);

    if($ps->rowCount() > 0){
        echo "Produto excluído com SUCESSO!";
    }
    else{
        echo "Produto não encontrado!";
    }
}catch(PDOException $e){
    die("Erro ao excluír: ". $e->getMessage());
}


// Listar

try{
    $pdo = conectar();

    $ps = $pdo->prepare("SELECT id, descricao, preco, quantidade FROM produto");

    $produtos = $ps-fetchAll();

    foreach($produtos as $p){
        echo p['id'] . ' o produto ' . p['descricao'] . 'tem o preço ' . p['preco'] . ', com a qtd ' .
        p['quantidade'], PHP_EOL;
    }
}catch(PDOException $e){
    die("Erro ao listar: " .$e->getMessage());
}

// Listar com comandos 

try{
    $pdo = conectar();

    $ps = $pdo->prepare("
        SELECT
            MAX(preco) AS precoMaximo,
            MIN(preco) AS precoMinimo,
            AVG(quantidade) AS mediaPreco
        FROM produto
    ");

    $registro = $ps->fetch();

    echo 'O Maior preço: ' . $registro['precoMaximo'];
    echo 'O Menor preço: ' . $registro['precoMinimo'];
    echo 'A Média do preço: ' . $registro['mediaPreco'];

}catch(PDOException $e){
    die("Erro ao listar: ".$e->getMessage());
}

