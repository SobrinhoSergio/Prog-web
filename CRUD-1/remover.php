<?php
require_once 'conexao.php';

echo 'REMOVER', PHP_EOL;

$id = readline( 'Id: ' );

$pdo = null;

try {
    $pdo = conectar();
    
    $ps = $pdo->prepare( 'DELETE FROM tarefa WHERE id = :id' );

    $ps->execute( [ 'id' => $id ] );

    echo 'Removido com sucesso.';

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

?>