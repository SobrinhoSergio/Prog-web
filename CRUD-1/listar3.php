<?php
require_once 'conexao.php';
$pdo = null;
try {
    $pdo = conectar();
    $ps = $pdo->prepare( 'SELECT * FROM tarefa' );
    $ps->execute();
    $registros = $ps->fetchAll();
    $tarefa = $registros[ 0 ];
    echo $tarefa[ 'descricao' ], PHP_EOL;

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

?>