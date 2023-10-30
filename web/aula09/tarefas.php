<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
</head>
<body>
    <form method="GET" action="tarefas.php" >
        <label for="pesquisa" >Pesquisa:</label>
        <input type="search" name="pesquisa" id="pesquisa" />
        <button type="submit" >Pesquisar</button>
    </form>
    <a href="cadastrar.html" >Novo</a>
    <h1>Tarefas</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Feita?</th>
                <th>Remoção</th>
                <th>Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'conexao.php';
            $pdo = conectar();
            gerarLinhas( $pdo );
            ?>
        </tbody>
    </table>
<?php

function gerarLinhas( PDO $pdo ) {

    $pesquisa = isset( $_GET[ 'pesquisa' ] )
        ? $_GET[ 'pesquisa' ] : '';

    $ps = $pdo->prepare(
        'SELECT id, descricao, feita FROM tarefa
        WHERE id LIKE :id OR descricao LIKE :descricao ' );
    $ps->execute( [
        'id' => '%'. $pesquisa . '%',
        'descricao' => '%'. $pesquisa . '%'
    ] );
    foreach ( $ps as $t ) {
        $feita = $t['feita'] ? '✅' : '❌';
        echo <<<LINHA
        <tr>
            <td>$t[id]</td>
            <td>$t[descricao]</td>
            <td>$feita</td>
            <td><a href="remover.php?id=$t[id]" >Remover</a></td>
            <td><a href="edicao.php?id=$t[id]" >Editar</a></td>
        </tr>
        LINHA;
    }
}
?>
</body>
</html>