<?php

require_once 'RepositorioCarro.php';
require_once 'Carro.php';
require_once 'RepositorioException.php';

class RepoistorioCarroEmBDR implements RepositorioCarro{

    private $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function cadastrar(Carro $c){

        try{

            $ps = $this->pdo->prepare("INSERT INTO carro (nome, fabricante, valor) VALUES (:nome, :fabricante, :valor)");

            $ps->execute([':nome' => $c->nome,
                          ':fabricante' => $c->fabricante,
                          ':valor' => $c->valor
            ]);

            $id = (int) $this->pdo->lastInsertId();

        }catch(PDOException $e){
            throw new RepostorioException("Erro ao Cadastrar: " . $e->getMessage());
        }

    }

    function listarCarro(){

        try{

            $ps = $this->pdo->prepare("SELECT id, nome, fabricante, valor FROM carro");

            $ps->execute();

            $registros = $ps->fetchAll();

            $carros = [];

            foreach($registros as $r){
                $carros = new Carros(
                    $r['id'],
                    $r['nome'],
                    $r['fabricante'],
                    $r['valor']
                ); 
            }

            return $carros;

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao listar: " . $e->getMessage());
        }

    }


    function removerPeloId($id){

        try{
            $ps = $this->pdo->prepare("DELETE FROM carro WHERE id = :id");

            $ps->execute([':id' => $id]);

            if($ps->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao Remover: " . $e->getMessage());
        }

    }

    function atualizar(Carro $c){

        try{

            $ps = $this->pdo->prepare('UPDATE carro SET nome = :nome, fabricante = :fabricante, valor = :valor WHERE id = :id');

            $ps->execute([':id' => $c->id,
                         ':nome' => $c->nome,
                         ':fabricante' => $c->fabricante,
                         ':valor' => $c->valor    
            ]);

            if($ps->rowCount()<1){
                return false;
            }

            else{
                return true;
            }

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao atualizar: " . $e->getMessage());
        }

    }


}


function conectar(){

    return new PDO("mysql:host=localhost;dbname=p2;charset=utf8",
                    'root',
                    'senha123',
                    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
                        
    );

}