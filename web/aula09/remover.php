<?php
    
    require_once 'conexao.php';
    
    $id = isset( $_GET['id'] ) ? $_GET['id'] : -1;
    
    if ( ! is_numeric( $id ) || $id <= 0 ) {
        die( 'Id inválido.' );
    }
    
    $pdo = conectar();
    
    $ps = $pdo->prepare( 'DELETE FROM tarefa WHERE id = :id' );
    
    $ps->execute( [ 'id' => $id ] );
    
    if ( $ps->rowCount() < 1 ) {
        die( 'Tarefa não encontrada.' );
    }
    
    echo 'Removida com sucesso: ', $id, '<br />',
        '<a href="tarefas.php" >Voltar</a>';

?>