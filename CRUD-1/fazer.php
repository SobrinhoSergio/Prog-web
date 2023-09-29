<?php
require_once 'conexao.php';

echo 'FAZER', PHP_EOL;

$id = readline( 'Id: ' );

$pdo = null;

try {
    
    $pdo = conectar();
    
    $ps = $pdo->prepare('UPDATE tarefa SET feita = NOT feita WHERE id = ?' );
        
    $ps->execute( [ $id ] );
    
    echo 'Atualizado com sucesso.';

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

?>