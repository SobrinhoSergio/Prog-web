<?php

require_once 'RepositorioConta.php';
require_once 'Conta.php';

class RepositorioContaEmBDR implements RepositorioConta {

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function obterTodos(){
        
        $ps = $this->pdo->prepare( 'SELECT * FROM conta' );
            
        $ps->execute();
        
        $registros = $ps->fetchAll();
        
        $contas = [];

                
        foreach ( $registros as $r ) {
            $contas []= new Conta(
                $r[ 'id' ],
                $r[ 'descricao' ],
                $r['tipo'],
                $r['valor'],
                $r['vencimento'],
                $r['paga'] == 1
            );
        }
        return $contas;
    }

}