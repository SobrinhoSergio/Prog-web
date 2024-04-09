<?php

class ContaBancaria{
    
    private $id = 0;
    private $nome = '';
    private $cpf = 0;
    private $saldo = 0;

    function __construct($id, $nome, $cpf, $saldo){
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->saldo = $saldo;
    }

    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function getNome(){
        return $this->nome;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function getCpf(){
        return $this->cpf;
    }

    function setCpf($cpf){
        $this->cpf = $cpf;
    }

    function getSaldo(){
        return $this->saldo;
    }

    function setSaldo($saldo){
        $this->saldo = $saldo;
    }

}

function cadastrar(ContaBancaria &$conta, PDO $pdo){
    $ps = $pdo->prepare("INSERT INTO conta (nome, cpf, saldo) VALUES (:nome, :cpf, :saldo)");
    $ps->execute([
        'nome' => $conta->getNome(),
        'cpf' => $conta->getCpf(),
        'saldo' => $conta->getSaldo()
    ]);
    $conta->setId((int) $pdo->lastInsertId());
}

function listar(PDO $pdo){
    $ps = $pdo->prepare("SELECT id, nome, cpf, saldo FROM conta");
    $registro = $ps->fetchAll();
    
    $c = [];

    foreach($registro as $conta){
        $c[] = new ContaBancaria(
            $registro['id'],
            $registro['nome'],
            $registro['cpf'],
            $registro['saldo']
        );
    }
    return $c;
}


function editar(ContaBancaria $conta, int $id, PDO $pdo){
    $ps = $pdo->prepare("UPDATE conta SET nome = :nome, cpf = :cpf, saldo = :saldo WHERE id = :id");
    $ps->execute([
        'id' => $id,
        'nome' => $conta->getNome(),
        'cpf' => $conta->getCpf(),
        'saldo' => $conta->getSaldo()
    ]);

    if($ps->rowCount()<1){
        return false;
    }
    return true;
}

function remover(int $id, PDO $pdo){
    $ps = $pdo->prepare("DELETE FROM conta WHERE id = :id");
    $ps->execute(['id' => $id]);

    if($ps->rowCount()<1){
        return false;
    }
    return true;
}

//=========================================== BANCO DADOS ====================================================

function conectar(){
    return new PDO(
        "mysql:host=localhost;dbname=provaP1;charset=utf8",
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
    );
}

//=========================================== CADASTRAR ======================================================

$pdo = null;

$nome = readline("Nome: ");
$cpf = readline("CPF: ");
$saldo = readline("Saldo: ");


$contaNova = new ContaBancaria(null, $nome, $cpf, $saldo);

try{
    $pdo = conectar();
    cadastrar($contaNova, $pdo);
}catch(PDOExceprion $e){
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

$contaBancariaEditada = new ContaBancaria(null, $descricaoNovo, $cpfNovo, $saldoNovo);

try{
    $pdo = conectar();
    $ok = editarContaBancaria($contaBancariaEditada, $pdo);

    if(ok){
        echo "Editado com Sucesso!";
    }
    else{
        echo "Item não encontrado!";
    }


}catch(PDOExceprion $e){
    die("Erro ao Cadastrar: " . $e->getMessage());
}

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

echo "Digite dois ids para excluí-los: ";

$id1 = readline("");
$id2 = readline("");

if(!is_numeric($id1) || $id1<=0){
    die("O Id1 precisa ser numérico!");
}

if(!is_numeric($id2) || $id2<=0){
    die("O Id2 precisa ser numérico!");
}

try{
    $pdo->beginTransaction();
    $ok = deletar($id1);

    if(!$ok){
        $pdo->roolback();
        return;
    }

    $ok = deletar($id2);

    if(!ok){
        $pdo->rollback();
        return;
    }

    $pdo->commit();
}catch(RepositorioException $e){
    $pdo->roolback();
    die($e->getMessage());
}