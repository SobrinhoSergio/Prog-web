<?php

require_once 'RepositorioConta.php';
require_once 'RepositorioException.php';

use excecoes\RepositorioException;

class RepositorioContaEmBDR implements RepositorioConta{

    private $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function cadastrar(Conta $c){

        try{

            $ps = $this->pdo->prepare("INSERT INTO conta (nome, fabricante, preco) VALUES (:nome, :fabricante, :preco)");

            $ps->execute([ 
                ':nome' => $c->nome,
                ':fabricante' => $c->fabricante,
                ':preco' => $c->preco
            ]);

            $c->id = (int) $this->pdo->lastInsertId();

    
        }catch(PDOException $e){
            throw new RepositorioException("Erro ao Cadastrar: ". $e->getMessage());
        }
    }

    function fraseComAutor(){

        try{

            $ps = $this->pdo->prepare("
            SELECT f.id, texto, nota, a.nome 
                FROM frase f JOIN autor a 
                ON f.autor_id = a.id
            ");

            $ps->execute();

            $registros = $ps->fetchAll();

            $frases = [];

            foreach($registros as $r){
                $frases[] = new FraseComAutor(
                    $r['id'],
                    $r['texto'],
                    $r['nota'],
                    $r['autor']
                );
            }

            return $frases;

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao consultar frases: " . $e->getMessage());
        }

    }

    function atualizar(Conta $c){
        
        try{
            $ps = $this->pdo->prepare("UPDATE conta SET nome = :nome, fabricante = :fabricante, preco = :preco WHERE id = :id");

            $ps->execute([
                ':id' => $c->id,
                ':nome' => $c->nome,
                ':fabricante' => $c->fabricante,
                ':preco' => $c->preco 
            ]);

            if($ps->rowCount()>0){
                return true;
            }
            else{
                return false;
            }

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao editar: " . $e->getMessage());
        }

    }

    function remover($id){

        try{
            $ps = $this->pdo->prepare("DELETE from conta WHERE id = :id");

            $ps->execute([':id' => $id]);

            if($ps->rowCount()>0){
                return true;
            }
            else{
                return false;
            }
        }catch(PDOException $e){
            throw new RepositorioException("Erro ao remover: " . $e->getMessage());
        }
    }
}
