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



$a = ("INSERT INTO produto (descricao, preco, estoque) VALUES (:desc, :preco, :estoque)");

$b = ("UPDATE produto SET descricao = :descricao, preco = :preco, estoque = :estoque WHERE id = :id");

$c = ("DELETE FROM produto WHERE id = :id");

$d = ("SELECT 
        c.id, 
        c.nome,
        c.cpf,
        s.saldo
    FROM Cliente c JOIN Saldo s 
    ON c.id = s.cliente_id ");

function editarProduto(PDO $pdo, PRODUTO $produto, $id){
    $ps = $pdo->prepare("UPDATE produto set descricao = :descricao, preco = :preco, estoque = :estoque WHERE id = :id");

    $ps->execute([
        'id' => $id,
        'descricao' => $produto->getDescricao(),
        'preco' => $produto->getPreco(),
        'estoque' => $produto->getEstoque(),

    ]);

    if($ps->rowCount() < 1){
        return false;
    }
    return true;
}


function cadastrarProduto(Produto &$produto, PDO $pdo){
    $ps = $pdo->prepare("INSERT INTO produto VALUES (descricao, preco, estoque) VALUES (:descricao, :preco, :estoque)");

    $ps->execute([
        'descricao' => $produto->getDescricao(),
        'preco' => $produto->getPreco(),
        'estoque' => $produto->getEstoque()
    ]);

    $produto->setId((int) $pdo->lastInsertId());
}

function listarProduto(PDO $pdo){
    $ps = $pdo->prepare("SELECT id, descricao, preco, estoque FROM produto");

    $registro = $ps->fetchAll();

    $produto = [];

    foreach($registros as $p){
        $produto[] = new Produto(
            $p['id'],
            $p['descricao'],
            $p['preco'],
            $p['estoque']
        ); 
    }
    return $produto;
}

function deletar(PDO $pdo, int $id){
    $ps = $pdo->prepare("DELETE FROM produto WHERE id = :id");

    $ps->execute(['id' => $id]);

    if($ps->rowCount()<1){
        return false;
    }
    return true;
}


// Usar o deletar

echo "Digite dois IDs que deseja deletar: ";

$id1 = readline("");
$id2 = readline("");

if(!is_numeric($id1) || $id < 0 ){
    die("O Id deve ser um número positivo");
}

$pdo = null;

try{
    $pdo = $conectar();
    
    $pdo->beginTransaction();
    
    $remover1 = deletar($id1, $pdo);

    if(!$remover1){
        $pdo->rollback();
        return;
    }

    $remover2 = deletar($id2, $pdo);

    if(!$remover2){
        $pdo->rollback();
        return;
    }

    $pdo->commit();
}catch(RepositorioException $e){
    $pdo->rollback();
    die($e->getMessage());
}

//listar 

try{
    $pdo = conectar();
    $p = listarProduto($pdo);

    foreach($p as $prod){
        echo 'Id' . $prod->getId() . ' Descrição ' . $prod->getDescricao() . ' Estoque ' . $prod->getEstoque() . ' Preço ' . $prod->getEstoque(); 
    }

}catch(RepositorioException $e){
    die("Erro ao listar: " .$e->getMessage());
}

// Cadastrar

$produto = new Produto(null, $descricao, $preco, $estoque);

$validar = $produto->validar();

if(!empty($validar)){
    foreach($validar as $mensagem){
        echo $mensagem;
    }
    exit();
}

//Validações

try{
    $pdo = conectar();

    cadastrarProduto($produto, $pdo);

    echo "Cadastrado com Sucesso!";
}catch(RepositorioException $e){
    die("Erro ao cadastrar: " .$e->getMessage());
}





