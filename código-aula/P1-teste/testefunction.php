<?php
// Class RepositorioException

namespace excecoes;

use \RuntimeException;

class RepositorioException extends RuntimeException{}

// ===============================================================

class Produto{
    private $id = 0;
    private $descricao = '';
    private $preco = 0;
    private $estoque = 0;


    function __construct( $id, $descricao, $preco, $estoque){
        $this->id = $id;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->estoque = $estoque;
    }

    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function validar(){
        $mensagem = [];

        if(!is_numeric($this->getId) || $this->getId() <= 0){
            array_push($mensagem,  "Id inválido!");
            //throw new RepositorioException("Id inválido!");
        }
    }
}

// =================================================================

function cadastrar(PDO $pdo, Produto $produto){
    $ps = $pdo->prepare("INSERT INTO produto (nome, preco, estoque) VALUES (:nome, :preco, :estoque)");

    $ps->execute([
        'nome' => $produto->getNome(),
        'preco' => $produto->getPreco(),
        'estoque' => $produto->getEstoque()
    ]);

}

function listar(PDO $pdo){
    $ps = $pdo->prepare("SELECT nome, preco, estoque FROM produto");

    $registro = $ps->fetchAll();

    $prod = [];

    foreach ($registro as $p){
        $prod[] = new Produto(
            $p['id'],
            $p['nome'],
            $p['preco'],
            $p['estoque']
        );
    }
    return $prod;
}

function editar(int $id, PDO $pdo, Produto $produto){
    $ps = $pdo->prepare("UPDATE produto SET nome = :nome, preco = :preco, estoque = :estoque WHERE id = :id");

    $ps->execute([
        'id' => $produto->getId(),
        'nome' => $produto->getNome(),
        'preco' => $produto->getPreco(),
        'estoque' => $produto->getEstoque()
    ]);

    if($ps->rowCount() < 1){
        return false;
    }

    return true;
}

function deletar(PDO $pdo, int $id){
    $ps = $pdo->prepare("DELETE FROM produto WHERE id = :id");

    $ps->execute(['id' => $id]);

    if($ps->rowCount() < 1){
        return false;
    }
    return true;
}


function conectar(){
    return new PDO("mysql:host=localhost;dbname=provaP1;charset=utf8",
                    'root',
                    '',
                    []                
    );
}

$pdo = null;

$id1 = readline("");
$id2 = readline("");

if(! is_numeric($id1) || $id <= 0){
    die("Digite um Id válido!");
}

try{
    $pdo = conectar();
    
    $pdo->beginTransaction();
    
    $deletar1 = deletar($pdo, $id1);
    
    if(!$deletar1){
        $pdo->rollback();
        return;
    }

    $deletar2 = deletar($pdo, $id2);

    if(!$deletar2){
        $pdo->rollback();
        return;
    }

}catch(PDOException $e){
    die("Erro ao deletar: " . $e->getMessage());
}