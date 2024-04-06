<?php

require_once 'conectar.php';

$pdo = null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare('SELECT id, cpf, nome, saldo FROM conta Order by saldo desc');
    $ps->setFetchMode(PDO::FETCH_ASSOC); 
    $ps->execute();

    foreach($ps as $conta){
        echo $conta['id'] . ' com o CPF ' . $conta['cpf'] . '. Nome da Pessoa: ' . $conta['nome'] . ', tem o saldo ' . $conta['saldo'], PHP_EOL;
    }

}catch(PDOException $e){
    die("Erro ao conectar ao Banco de Dados. ". $e->getMessage());
}

