<?php

class ContaBancaria {

    private $id = 0;
    private $nome = '';
    private $cpf = '';
    private $saldo = 0;

    function __construct( $id, $nome, $cpf, $saldo ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->saldo = $saldo;
    }

    function getId() { return $this->id; }
    function setId( $id ) { $this->id = $id; }
    function getNome() { return $this->nome; }
    function setNome( $nome ) { $this->nome = $nome; }
    function getCpf() { return $this->cpf; }
    function setCpf( $cpf ) { $this->cpf = $cpf; }
    function getSaldo() { return $this->saldo; }
    function setSaldo( $saldo ) { $this->saldo = $saldo; }

}

function contasBancarias( PDO $pdo ) {
    $ps = $pdo->query( 'SELECT * FROM conta' );
    $registros = $ps->fetchAll();
    $objetos = [];
    foreach ( $registros as $r ) {
        $obj = new ContaBancaria(
            $r[ 'id' ],
            $r[ 'nome' ],
            $r[ 'cpf' ],
            $r[ 'saldo' ],
        );
        $objetos []= $obj;
    }
    return $objetos;
}

function adicicionarContasBancaria( ContaBancaria &$conta, PDO $pdo ) {
    $ps = $pdo->prepare( 'INSERT INTO conta ( nome, cpf, saldo ) VALUES
        ( :nome, :cpf, :saldo )' );
    $ps->execute( [
        'nome' => $conta->getNome(),
        'cpf' => $conta->getCpf(),
        'saldo' => $conta->getSaldo()
    ] );
    $conta->setId( (int) $pdo->lastInsertId() );
}

?>