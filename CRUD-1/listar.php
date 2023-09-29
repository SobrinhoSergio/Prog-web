<?php
require_once 'conexao.php';

$pdo = null;

try {
    
    $pdo = conectar();
    
    $ps = $pdo->prepare( 'SELECT * FROM tarefa' );
    
    $ps->execute();
    
    foreach ( $ps as $tarefa ) {
        echo $tarefa[ 'id' ], ' ', $tarefa[ 'descricao'],
            ' ', $tarefa[ 'feita' ] ? 'Sim' : 'Não', PHP_EOL;
    }

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

?>