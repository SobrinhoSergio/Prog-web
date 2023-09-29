<?php
require_once 'conexao.php';

echo 'PESQUISAR', PHP_EOL;

$descricao = readline( 'Descrição: ' );

$pdo = null;

try {
    $pdo = conectar();
    
    $ps = $pdo->prepare('SELECT * FROM tarefa WHERE descricao LIKE :descricao' );
    
    $ps->execute( [ 'descricao' => '%' . $descricao . '%' ]);
    
    foreach ( $ps as $tarefa ) {
        echo $tarefa[ 'id' ], ' ', $tarefa[ 'descricao'],
            ' ', $tarefa[ 'feita' ] ? 'Sim' : 'Não', PHP_EOL;
    
    }

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

?>