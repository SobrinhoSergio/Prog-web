<?php

function atualizarCliente( $id, $nome, $saldo ) {

    $pdo = new PDO( 'mysql:dbname=aula11;host=localhost;charset=utf8',
    'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );

    try {
        $pdo->beginTransaction();

        $ps = $pdo->prepare(
            'UPDATE cliente SET nome = :nome, saldo = :saldo WHERE id = :id'
        );
        $ps->execute( [ 'id' => $id, 'nome' => $nome, 'saldo' => $saldo ] );

        $pdo->commit();
        return true;
    } catch ( PDOException $e ) {
        $pdo->rollBack();
        return false;
    }

}

?>