<?php

require_once 'conectar.php';

$pdo = null;

$cpfOrigem = readline("Digite CPF de origem: ");
$cpfDestino = readline("Digite CPF de destino: ");
$valor = readline("Digite um valor: ");

try{
    $pdo = conectar();

    $ps = $pdo->prepare("SELECT id FROM contas WHERE cpf = :cpf");

    $ps->execute(['cpf' => $cpfOrigem]);

    if($ps->rowCount<0){
        die("Cliente origem não exite!");
    }

    $linha = $ps->fetch();
    $saldo = $linha['saldo'];

    if($saldo < $valor){
        throw new Exception( 'Cliente origem sem saldo suficiente.' );
    }

    $pdo->beginTransaction();

    $ps->prepare("UPDATE conta SET saldo = saldo - :valor WHERE cpf = :cpf");

    $ps->execute(['cpf' => $cpfDestino]);

}