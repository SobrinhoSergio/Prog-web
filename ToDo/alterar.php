<?php
    require_once 'conexao.php';

    $id = isset( $_POST[ 'id' ] ) ? $_POST[ 'id' ] : -1;
    
    $descricao = isset( $_POST[ 'descricao' ] ) ? $_POST[ 'descricao' ] : '';
    
    $feita = isset( $_POST[ 'feita' ] ) ? $_POST[ 'feita' ] == '1' : false;

    $tamanhoDescricao = mb_strlen( $descricao );
    
    if ( $tamanhoDescricao < 2 || $tamanhoDescricao > 100 ) {
        die( 'Por favor, informe um descricao com de 2 a 100 caracteres.' );
    }

    try {
        $pdo = conectar();
        
        $ps = $pdo->prepare('UPDATE tarefa SET descricao = :descricao, feita = :feita WHERE id = :id' );
        
        $ps->execute( [
            'descricao' => $descricao,
            'feita' => $feita,
            'id' => $id
        ] );
        
        header( 'Location: tarefas.php' );
    
    } catch ( PDOException $e ) {
        die( 'Erro ao atualizar a tarefa.' );
    }
?>