<?php

require_once 'repositorio-exception.php';
require_once 'repositorio-produto.php';
require_once 'produto.php';

class RepositorioProdutoEmBdr implements RepositorioProduto{
    
    private $pdo = null;

    function __constructor(PDO $pdo){
        $this->pdo = $pdo;
    }

    function cadastrar(Produto $produto){
        try{
            $ps = $this->pdo->prepare("INSERT INTO produto (descricao, preco, quantidade) VALUES (:descricao, :preco, :quantidade)");

            $ps->execute([
                'descricao' => $produto->descricao,
                'preco' => $produto->preco,
                'quatidade' => $produto->quantidade
            ]);

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao Cadastrar: ".$e->getMessage());
        }
    }

    function editar(int $id, Produto $produto){
        try{
            $ps = $this->pdo->prepare("UPDATE produto SET descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id");

            $ps->execute([
                'id' => $id,
                'descricao' => $produto->descricao,
                'preco' => $produto->preco,
                'quantidade' => $produto->quantidade
            ]);

            if($ps->rowCount() < 1){
                return false;
            }
            return false;
        }catch(PDOException $e){
            throw new RepositorioException("Erro ao editar: " . $e->getMessage());
        }
    }

    function deletar(int $id){
        try{
            $ps = $this->pdo->prepare("DELETE FROM produto WHERE id = :id");

            $ps->execute(['id' => $id]);
    
            if($ps->rowCount() < 1){
                return false;
            }
            return true;
        }catch(PDOException $e){
            throw new RepositorioException("Erro ao deletar: ".$e-getMessage());
        }

    }

    function listar(){
        try{
            $ps = $this->pdo->prepare("SELECT id, descricao, preco, quantidade FROM produto");

            $registros = $ps->fetchAll();

            $prod = [];

            foreach($registros as $p){
                $prod[] = new Produto(
                    $p['id'],
                    $p['quantidade'],
                    $p['preco'],
                    $p['quantidade'],
                ) ;
            }
            return $prod;

        }catch(PDOException $e){
            throw new RepositorioException('Erro ao listar: '.$e->getMessage());
        }
    }
}

?>

function listar(){
    $ps = $this->pdo->prepare("SELECT id, descricao, preco, quantidade FROM produto");

    $registros = $ps->fetchAll();

    $prod = [];

    foreach($registros as $p){
        $prod [] = new Produto(
            $p['id'],
            $p['descricao'],
            $p['preco'],
            $p['quantidade']            
        );
    }
    return $prod;
}