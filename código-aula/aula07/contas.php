<?php
$pdo = null;
try {
    $pdo = new PDO(
        'mysql:dbname=aula7;host=localhost;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
        );

    listarContas( $pdo );
} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

function listarContas( $pdo ) {
    $ps = $pdo->query( 'SELECT * FROM conta' );
    $contas = $ps->fetchAll();
    foreach ( $contas as $c ) {
        echo $c[ 'id' ], ') ',
            $c[ 'cpf' ], ' ',
            $c[ 'nome' ], ' ',
            $c[ 'saldo' ], PHP_EOL;
    }
}

?>