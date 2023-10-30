<?php
    require_once 'conexao.php';

    $descricao = isset( $_POST[ 'descricao' ] ) ? $_POST[ 'descricao' ] : '';
    
    $feita = isset( $_POST[ 'feita' ] ) ? $_POST[ 'feita' ] == '1' : false;

    $tamanhoDescricao = mb_strlen( $descricao );
    
    if ( $tamanhoDescricao < 2 || $tamanhoDescricao > 100 ) {
        die( 'Por favor, informe um descricao com de 2 a 100 caracteres.' );
    }

    try {
        $pdo = conectar();
        
        $ps = $pdo->prepare('INSERT INTO tarefa ( descricao, feita ) VALUES ( :descricao, :feita )' );
        
        $ps->execute([
            'descricao' => $descricao,
            'feita' => $feita
        ]);

        header( 'Location: tarefas.php' );

    } catch ( PDOException $e ) {
        die( 'Erro ao cadastrar a tarefa.' );
    }
?>