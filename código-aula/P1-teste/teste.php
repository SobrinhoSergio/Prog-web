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

    public function validar() {
        $mensagens = [];
                
        if (!is_numeric($this->getId()) || $this->getId() <= 0) {
            array_push($mensagens, 'O ID deve ser um número inteiro positivo');
        } 
    
        $tamNome = mb_strlen($this->getNome());
        
        if ($tamNome < 2 || $tamNome > 100) {
            array_push($mensagens, 'O nome deve ter entre 2 e 100 caracteres');
        }
    
        $tamCpf = mb_strlen($this->getCpf());

        if ($tamCpf != 11) {
            array_push($mensagens, 'O CPF deve conter exatamente 11 dígitos numéricos');
        }
    
        if (!is_numeric($this->getSaldo()) || $this->getSaldo() < 0) {
            array_push($mensagens, 'O saldo deve ser um número e no mínimo zero');
        }
    
        return $mensagens;
    }
    
}

function cadastrar(ContaBancaria &$conta, PDO $pdo){
    $ps = $pdo->prepare("INSERT INTO conta (nome, cpf, saldo) VALUES (:nome, :cpf, :saldo)");
    $ps->execute([
        'nome' => $conta->getNome(),
        'cpf' => $conta->getCpf(),
        'saldo' => $conta->getSaldo()
    ]);
    $conta->setId((int) $pdo->lastInsertId()); // Ou seja, vai ser auto incremental
}

function listar(PDO $pdo){
    $ps = $pdo->prepare("SELECT id, nome, cpf, saldo FROM conta");
    $registro = $ps->fetchAll();
    
    $c = [];

    foreach($registro as $conta){
        $c[] = new ContaBancaria(
            $conta['id'],
            $conta['nome'],
            $conta['cpf'],
            $conta['saldo']
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

$mensagens = $contaNova->validar();

// Se houver mensagens de erro, exibir e sair do script
if (!empty($mensagens)) {
    echo "Erro ao cadastrar: \n";
    foreach ($mensagens as $mensagem) {
        echo $mensagem;
    }
    exit();
}

try{
    $pdo = conectar();
    cadastrar($contaNova, $pdo);
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

$contaBancariaEditada = new ContaBancaria(null, $descricaoNovo, $cpfNovo, $saldoNovo);

try{
    $pdo = conectar();
    $ok = editarContaBancaria($contaBancariaEditada, $id, $pdo);

    if(ok){
        echo "Editado com Sucesso!";
    }
    else{
        echo "Item não encontrado!";
    }


}catch(PDOException $e){
    die("Erro ao Cadastrar: " . $e->getMessage());
}

//=========================================== LISTAR ==========================================================


try {
    $pdo = conectar();
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
        $pdo->rollback();
        return;
    }

    $ok = deletar($id2);

    if(!ok){
        $pdo->rollback();
        return;
    }

    $pdo->commit();
}catch(RepositorioException $e){
    $pdo->rollback();
    die($e->getMessage());
}


function deletar(int $id, PDO $pdo){}

class a{
    private $pdo = null;

    function construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function deletar(int $id){
        try{
            $ps = $this->pdo->prepare("DELETE FORM produto WHERE id = :id");
            $ps->execute(['id' => $id]);

            if($ps->rowCount < 1){
                return false;
            }
            return true;
        }catch(PDOException $e){
            throw new RepositorioException("Erro ao deletar: ".$e->getMessage());
        }
    }
}

