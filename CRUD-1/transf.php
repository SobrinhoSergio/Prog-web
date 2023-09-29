<?php
require_once 'conexao.php';

$idOrigem = readline( 'Id do cliente origem: ' );
$idDestino = readline( 'Id do cliente origem: ' );
$valor = (int) readline( 'Valor: ' );

$pdo = null;
try {
    $pdo = conectar();
    $ps = $pdo->prepare( 'SELECT saldo FROM cliente WHERE id = ?' );
    $ps->execute( [ $idOrigem ]);
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
        'UPDATE cliente SET saldo = saldo - :valor WHERE id = :id' );
    $ps->execute( [ 'valor' => $valor, 'id' => $idOrigem ] );

    $ps = $pdo->prepare(
        'UPDATE cliente SET saldo = saldo + :valor WHERE id = :id' );
    $ps->execute( [ 'valor' => $valor, 'id' => $idDestino ] );
    if ( $ps->rowCount() < 1 ) {
        throw new Exception( 'Cliente destino não encontrado.' );
    }

    $pdo->commit();

} catch ( Exception $e ) {
    $pdo->rollBack();
    die( 'Erro: ' . $e->getMessage() );
}

?>