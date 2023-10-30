<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefa</title>
</head>
<body>
    <h1>Cadastro</h1>
    <form action="cadastrar2.php" method="POST" >
        <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" />
        <input type="checkbox" name="feita" id="feita" value="1" />
        <label for="feita">Feita</label>
        <button type="submit" id="salvar">Salvar</button>
    </form>
<?php
    require_once 'conexao.php';

    // Não enviou ainda
    if ( ! isset( $_POST[ 'descricao' ] ) ) {
        die();
    }

    $descricao = isset( $_POST[ 'descricao' ] ) ? $_POST[ 'descricao' ] : '';
    $feita = isset( $_POST[ 'feita' ] ) ? $_POST[ 'feita' ] == '1' : false;

    $tamanhoDescricao = mb_strlen( $descricao );
    if ( $tamanhoDescricao < 2 || $tamanhoDescricao > 100 ) {
        die( 'Por favor, informe um descricao com de 2 a 100 caracteres.' );
    }

    try {
        $pdo = conectar();
        $ps = $pdo->prepare(
            'INSERT INTO tarefa ( descricao, feita ) VALUES ( :descricao, :feita )' );
        $ps->execute( [
            'descricao' => $descricao,
            'feita' => $feita
        ] );
        // Redireciona
        header( 'Location: tarefas.php' );
    } catch ( PDOException $e ) {
        die( 'Erro ao cadastrar a tarefa.' );
    }
?>
</body>
</html>