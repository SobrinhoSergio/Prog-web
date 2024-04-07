<?php

namespace Mma;

require_once "repositorio-lutador.php";
require_once "repositorio-exception.php";

class RepositorioLutadorBdr implements RepositorioLutador{

    private $pdo = null;

    function __constructor(PDO $pdo){
        $this->pdo = $pdo;
    }

    function cadastrarLutador(Lutador $lutador){
        try{
            $ps = $this->pdo->prepare("INSERT INTO lutador (nome, idade, peso, altura) VALUES (nome, idade, peso, altura)");

            $ps->excute([
                'nome' => $lutador->nome,
                'idade' => $lutador->idade,
                'peso' => $lutador->peso,
                'altura' => $lutador->altura
            ]);
        }catch(PDOException $e){
            throw new RepositorioException('Erro ao cadastrar: '.$e->getMessage());
        }
    }

    function editarLutador(int $id, Lutador $lutador){
        
        try{
            $ps = $this->pdo->prepare("UPDATE lutador SET nome = :nome, idade = :idade, peso = :peso, altura = :altura WHERE id = :id");

            $ps->execute([
                'id' => $id,
                'nome' => $lutador->nome,
                'idade' => $lutador->idade,
                'peso' => $lutador->peso,
                'altura' => $lutdor->altura
            ]);
    
            if($ps->rowCount() < 1){
                return false;
            }
    
            return true;
        }catch(PDOException $e){
            throw new RepositorioException('Erro ao Editar: '.$e->getMessage());
        }
    }

    function deletarLutador(int $id){
        try{

            $ps = $this->pdo->prepare("DELETE FROM lutador WHERE id = :id");

            $ps->execute(['id' => $id]);

            if($ps->rowCount()<1){
                return false;
            }

            return true;
        }catch(PDOException $e){
            throw new RepositorioException('Erro ao deletar: '. $e->getMessage());
        }

    }

    function listarLutadores(){

        try{

            $ps = $this->pdo->prepare("SELECT id, nome, idade, peso, altura FROM lutador");

            $registros = $ps->fetchAll();
    
            $c = [];
    
            foreach($registros as $l){
                $c[] = new Lutador(
                    $l['id'],
                    $l['nome'],
                    $l['idade'],
                    $l['peso'],
                    $l['altura'],
                );
            }
            return $c;

        }catch(PDOException $e){
            throw new RepositorioException('Erro ao listar: '.$e->getMessage());
        }
  
    }
        

}