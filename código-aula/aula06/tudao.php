<?php

require_once "conectar.php";

function conectar(){
    return new PDO(
        "mysql:host=localhost;dbname=aula01;charset=utf8",
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
    );
}

$pdo=null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare("INSERT INTO produtos (descricao, preco, quantidade) VALUES (:descricao, :preco, :quantidade)");

    $ps->execute(['descricao' => $descricao, 'preco' => $preco, 'quantiade' => $quantidade]);

    echo "Cadastrado com Sucesso";

}catch(PDPException $e){
    die("Erro ao conectar: ".$e->getMessage());
}


try{
    $pdo = conectar();

    $ps = $pdo->prepare("UPDATE produto SET descricao = :descricao, preco = :preco, quantidade = :quantidade
    WHERE id = :id");

    $ps->execute(['id' => $id, 'descricao' => $descricao, 'preco' => $preco, 'quantidade' => $quantidade]);

    if($ps->rowCount()>0){
        echo "Editado com sucesso!";
    }
    else{
        echo 'Nenhum produto encontrado com o ID fornecido.';
    }

}catch(PDOException $e){
    die("Erro ao conectar: ". $e->getMessage());
}

try{
    $pdo = conectar();

    $pd = $pdo->prepare("DELETE FROM produto WHERE id = :id");

    $ps->execute(['id' => $id]);

    echo "Removido com Sucesso!";
}catch(PDOException $e){
    die("Erro ao conectar: ".$e->getMessage());
}

try{
    $pdo = conectar();

    $ps = $pdo->prepare("SELECT id, descricao, preco, quantidade FROM produto");

    $ps->execute();

    $registros = $ps->fetchAll();

    foreach($registros as $p){
        echo $p['id'] .' com o produto' . $p['descricao'] . ' com o preço ' . $p['preco'] . 'que tem a qtd' . $p['quantidade'], PHP_EOL;
    }
}catch(PDOException $e){
    die("Erro ao conectar: ".$e->getMessage());
}

$pdo= null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare(" SELECT
        SUM(estoque) AS somaEstoque,
        MAX(estoque) AS MaiorEstoque,
        MIN(estoque) AS MinorEstoque,
        AVG(quantidade) AS mediaQtd
    FROM produtos
    ");

    $dados = $ps->fetch();

    echo 'A soma do estoque é: '. $dados['somaEstoque'];
    echo 'O maior valor de estoque é: ' . $dados['maiorEsoque'];

}catch(PDOException $e){
    die("Erro ao conectar: ".$e->getMessage());
}

