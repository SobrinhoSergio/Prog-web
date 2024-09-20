<?php

require_once 'RepositorioConta.php';

use \acme\RepositorioException;
use \acme\Conta;
use \acme\RepositorioConta;


class RepositorioContaEmBDR implements RepositorioConta{

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function conta(){

        try{

            $ps = $this->pdo->prepare("SELECT id, descricao, valor FROM conta");

            $ps->execute(); 
                
            $registros =  $ps->fetchAll();
            
            $conta = [];
            
            foreach ( $registros as $r ) {
                
                $conta [] = new Conta(
                    $r[ 'id' ], 
                    $r[ 'descricao' ], 
                    $r[ 'valor'],
                );
            }
            return $conta;
    
        }catch(PDOExecption $e){
            Throw new RepositorioException("Erro ao listar ", $e->getMessage());
        }

       
    }
    
    public function adicionar( Conta $c ){

        try{

            $ps = $this->pdo->prepare("INSERT INTO conta ( descricao, valor ) VALUES ( :descricao, :valor )");
        
            $ps->execute([ ':descricao' => $c->descricao, 
                            ':valor' => $c->valor]);
            
            $c->id = (int) $this->pdo->lastInsertId();

        }catch(PDOExecption $e){
            Throw new RepositorioException("Erro ao listar ", $e->getMessage());
        }

    }
}