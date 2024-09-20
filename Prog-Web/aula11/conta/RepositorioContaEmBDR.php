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
                $r['id'],
                $r['descricao'],
                $r['tipo'],
                $r['valor'],
                $r['vencimento'],
                $r['paga'] == 1
            );
        }
        return $contas;
    }

    public function adicionar( Conta $c ) {
       
        $ps = $this->pdo->prepare( 'INSERT INTO conta (id, descricao, valor, tipo, vencimento, paga)
            VALUES (:id, :descricao, :valor, :tipo, :vencimento, :paga )');
        
        $ps->execute([ 'id' => $c->id,
                       'descricao' => $c->descricao,
                       'valor' => $c->valor,
                       'tipo' => $c->tipo,
                       'vencimento' => $c->vencimento,
                       'paga' => $c->paga ? 1 : 0
        ]);
    }

    public function removerPeloId( $id ) {
        
        $ps = $this->pdo->prepare( 'DELETE FROM conta WHERE id = :id' );
        
        $ps->execute( [ 'id' => $id ] );
    }


    public function calcularSaldoTotal() {
  
        $ps = $this->pdo->prepare("SELECT SUM(valor) as total FROM conta");

        $ps->execute();
        
        $result = $ps->fetchAll();

        return floatval($result['total']);
    }

}