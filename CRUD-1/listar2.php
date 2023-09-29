<?php
require_once 'conexao.php';
$pdo = null;
try {
    $pdo = conectar();
    $ps = $pdo->prepare( 'SELECT * FROM tarefa' );
    $ps->execute();
    if ( $ps->rowCount() < 1 ) { // Contagem de linhas
        die( 'Não encontrado.' );
    }
    $tarefa1 = $ps->fetch(); // array com os campos
    echo $tarefa1[ 'descricao' ], PHP_EOL;
    // $tarefa2 = $ps->fetch();
    // echo $tarefa2[ 'descricao' ], PHP_EOL;

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

?>