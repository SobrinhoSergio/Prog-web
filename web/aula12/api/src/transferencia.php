<?php

function transferir(
    $origemId,
    $destinoId,
    $valor
) {
    $pdo = new PDO( 'mysql:dbname=aula11;host=localhost;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );

    try {
        $pdo->beginTransaction();

        $ps = $pdo->prepare( 'INSERT INTO movimentacao_saldo
            (  tipo,  valor,  origem_id,  destino_id ) VALUES
            ( :tipo, :valor, :origem_id, :destino_id )' );
        $ps->execute( [
            'tipo'          => 'D',
            'valor'         => $valor,
            'origem_id'     => $origemId,
            'destino_id'    => $destinoId
        ] );

        $ps2 = $pdo->prepare(
            'UPDATE cliente SET saldo = saldo - :valor WHERE id = :origem_id'
        );
        $ps2->execute( [ 'valor' => $valor, 'origem_id' => $origemId ] );

        $ps3 = $pdo->prepare(
            'UPDATE cliente SET saldo = saldo + :valor WHERE id = :destino_id'
        );
        $ps3->execute( [ 'valor' => $valor, 'destino_id' => $destinoId ] );

        $pdo->commit();
        return true;
    } catch ( PDOException $e ) {
        $pdo->rollBack();
        return false;
    }

}

?>