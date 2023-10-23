<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
    <style>
        thead {
            background-color: black;
            color: white;
        }
        tbody tr:nth-child(odd) {
            background-color: moccasin;
        }
    </style>
</head>
<body>
    <a href="cadastro.html" >Cadastro</a>
    <?php
    // Checa se há a chave ordem nos parâmetros
    $ordem = isset( $_GET[ 'ordem' ] ) ? $_GET[ 'ordem' ] : 'nome';
    if ( array_search( $ordem, [ 'id', 'nome', 'telefone' ] ) === false ) {
        $ordem = 'nome';
    }
    echo 'Ordem: ', $ordem;
    $direcao = isset( $_GET[ 'direcao' ] ) ? $_GET[ 'direcao' ] : 'ASC';
    if ( array_search( $direcao, [ 'ASC', 'DESC' ] ) === false ) {
        $direcao = 'ASC';
    }
    echo 'Direção: ', $direcao;

    $nome = isset( $_GET[ 'nome' ] ) ? $_GET[ 'nome' ] : '';

    ?>
    <h1>Contatos</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Remoção</th>
            </tr>
        </thead>
        <tbody>
            <?php
            gerarLinhas();
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
function gerarLinhas() {
    global $ordem, $direcao, $nome;
    $pdo = null;
    try {
        $pdo = new PDO( 'mysql:dbname=aula08;host=localhost;charset=utf8',
            'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );

        $ps = $pdo->prepare(
            'SELECT id, nome, telefone FROM contato ' .
            " WHERE nome LIKE ? " .
            ' ORDER BY ' . $ordem . ' ' . $direcao );
        $ps->execute( [ '%' . $nome . '%' ] );

        while ( $c = $ps->fetchObject() ) {
            echo '<tr>',
                '<td>', $c->id, '</td>',
                '<td>', $c->nome, '</td>',
                '<td>', $c->telefone, '</td>',
                '<td><a href="remover.php?id=' . $c->id . '" >🔥</a><td>' .
                '</tr>';
        }
    } catch ( PDOException $e ) {
        die( 'Erro: ' . $e->getMessage() );
    }
}
?>