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

    function getId() { 
        return $this->id; 
    }
    
    function setId( $id ) {
        $this->id = $id; 
    }
    
    function getNome() { 
        return $this->nome; 
    }
    
    function setNome( $nome ) { 
        $this->nome = $nome; 
    }
    
    function getCpf() { 
        return $this->cpf; 
    }
    
    function setCpf( $cpf ) { 
        $this->cpf = $cpf; 
    }
    
    function getSaldo() { 
        return $this->saldo; 
    }
    
    function setSaldo( $saldo ) { 
        $this->saldo = $saldo; 
    }

}

function contasBancarias( PDO $pdo ) {
    $ps = $pdo->query( 'SELECT * FROM conta' );
    $registros = $ps->fetchAll();
    $objetos = [];
    foreach ( $registros as $r ) {
        $objetos[] = new ContaBancaria(
            $r[ 'id' ],
            $r[ 'nome' ],
            $r[ 'cpf' ],
            $r[ 'saldo' ],
        );
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

function editarContaBancaria( ContaBancaria $conta, PDO $pdo, int $id ) {
    $ps = $pdo->prepare( 'UPDATE conta SET nome = :nome, cpf = :cpf, saldo = :saldo WHERE id = :id' );
    $ps->execute( [
        'id' => $id,
        'nome' => $conta->getNome(),
        'cpf' => $conta->getCpf(),
        'saldo' => $conta->getSaldo()
    ] );
}

function excluirContaBancaria(int $id, PDO $pdo ) {
    $ps = $pdo->prepare( 'DELETE FROM conta WHERE id = :id' );
    $ps->execute( [ 'id' => $id ] );
}



//=========================================== BANCO DADOS ====================================================


try {
    $pdo = new PDO("mysql:host=localhost;dbname=provaP1;charset=utf8", 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(PDOException $e) {
    die("Erro ao conectar ao Banco de Dados: " . $e->getMessage());
}

//=========================================== CADASTRAR ======================================================

echo "Cadastro de Produto\n";

$descricao = readline("Descrição: ");
$cpf = readline("CPF: ");
$saldo = readline("Saldo: ");

// Validações

$contaNova = new ContaBancaria(null, $descricao, $cpf, $saldo);

try{
    adicionarContaBancaria($novaConta, $pdo);
    echo "Conta bancária cadastrada com sucesso!";

}catch(PDOException $e){
    die("Erro ao Cadastrar: " . $e->getMessage());
}



//=========================================== EDITAR =========================================================


$id = readline("Qual item deseja editar: ");

if(!is_numeric($id) || $id <= 0){
    die("Id deve ser um número positivo");
}

$descricaoNovo = readline("Descrição: ");
$cpfNovo = readline("CPF: ");
$saldoNovo = readline("Saldo: ");

$contaBancariaEditada = new ContaBancaria(null, $descricao, $cpf, $saldo);

editarContaBancaria($contaBancariaEditada, $pdo);

//=========================================== LISTAR ==========================================================


try {
    $contas = contasBancarias($pdo);
    foreach ($contas as $conta) {
        echo "ID: " . $conta->getId() . ", Nome: " . $conta->getNome() . ", CPF: " . $conta->getCpf() . ", Saldo: " . $conta->getSaldo() . "<br>";
    }
} catch (PDOException $e) {
    echo 'Erro ao listar contas: ' . $e->getMessage();
}


//=========================================== DELETAR ======================================================

$id = readline("Qual item deseja excluír: ");

if(!is_numeric($id) || $id <= 0){
    die("Id deve ser um número positivo");
}

excluirContaBancaria($id, $pdo);

