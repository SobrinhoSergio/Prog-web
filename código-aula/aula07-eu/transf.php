<?php
require_once 'conectar.php';

$cpfOrigem = readline( 'CPF do cliente origem: ' );
$cpfDestino = readline( 'CPF do cliente destino: ' );
$valor = (int) readline( 'Valor: ' );

$pdo = null;

try {
    $pdo = conectar();
    
    $ps = $pdo->prepare( 'SELECT saldo FROM conta WHERE cpf = :cpf' );
    
    $ps->execute( [ 'cpf' => $cpfOrigem ]);
    
    if ( $ps->rowCount() < 0 ) {
        die( 'Cliente origem não encontrado.' );
    }

    $linha = $ps->fetch();
    
    $saldo = $linha[ 'saldo' ];
    
    if ( $saldo < $valor ) {
        throw new Exception( 'Cliente origem sem saldo suficiente.' );
    }
    
    $pdo->beginTransaction();
    
    $ps = $pdo->prepare(
        'UPDATE conta SET saldo = saldo - :valor WHERE cpf = :cpf' );
    
    $ps->execute( [ 'valor' => $valor, 'cpf' => $cpfOrigem ] );

    $ps = $pdo->prepare(
        'UPDATE conta SET saldo = saldo + :valor WHERE cpf = :cpf' );
    
    $ps->execute( [ 'valor' => $valor, 'cpf' => $cpfDestino ] );
    
    if ( $ps->rowCount() < 1 ) {
        throw new Exception( 'Cliente destino não encontrado.' );
    }

    $pdo->commit();

} catch ( Exception $e ) {
    $pdo->rollBack();
    die( 'Erro: ' . $e->getMessage() );
}

?>