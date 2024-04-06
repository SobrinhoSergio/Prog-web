<?php
$pdo = null;
try {
    $pdo = new PDO(
        'mysql:dbname=aula7;host=localhost;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );

    $cpfOrigem = readline( 'CPF da conta origem: ' );
    $cpfDestino = readline( 'CPF da conta destino: ' );
    if ( ! contaExiste( $cpfOrigem, $pdo ) ) {
        die( 'Conta origem não existe.' );
    }
    if ( ! contaExiste( $cpfDestino, $pdo ) ) {
        die( 'Conta destino não existe.' );
    }

    $valor = readline( 'Valor a transferir: R$ ' );
    if ( ! is_numeric( $valor ) || $valor <= 0 ) {
        die( 'Valor deve ser um número positivo.' );
    }
    if ( ! contemSaldo( $cpf, $saldo, $pdo ) ) {
        die( 'Conta origem sem saldo suficiente.' );
    }

    $pdo->beginTransaction();

    realizarTransferencia( $cpfOrigem, $cpfDestino, $valor, $pdo );

    $pdo->commit();

    echo 'Transferido com sucesso.';

} catch ( PDOException $e ) {
    if ( $pdo->inTransaction() ) {
        $pdo->rollBack();
    }
    die( 'Erro: ' . $e->getMessage() );
}

function contaExiste( $cpf, $pdo ) {
    $ps = $pdo->prepare(
        'SELECT id FROM conta WHERE cpf = :cpf' );
    $ps->execute( [ 'cpf' => $cpf ]);
    return $ps->rowCount() > 0;
}

function contemSaldo( $cpf, $saldo, $pdo ) {
    $ps = $pdo->prepare( 'SELECT id FROM conta
        WHERE cpf = :cpf AND saldo >= :saldo'
    );
    $ps->execute( [ 'cpf' => $cpf, 'saldo' => $saldo ] );
    return $ps->rowCount() > 0;
    // $ps = $pdo->prepare( 'SELECT saldo FROM conta
    //     WHERE cpf = :cpf'
    // );
    // $ps->execute( [ 'cpf' => $cpf ] );
    // $linha = $ps->fetch();
    // return isset( $linha[ 'saldo' ] ) &&
    //     $linha[ 'saldo' ] >= $saldo;
}

function realizarTransferencia(
    $cpfOrigem, $cpfDestino, $valor, $pdo
) {
    $ps = $pdo->prepare( 'UPDATE conta SET saldo = saldo - :valor
        WHERE cpf = :cpf' );
    $ps->execute( [ 'valor' => $valor, 'cpf' => $cpfOrigem ] );

    $ps = $pdo->prepare( 'UPDATE conta SET saldo = saldo + :valor
        WHERE cpf = :cpf' );
    $ps->execute( [ 'valor' => $valor, 'cpf' => $cpfDestino ] );
}

?>