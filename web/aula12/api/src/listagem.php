<?php
function listarClientes() {

    $pdo = new PDO( 'mysql:dbname=aula11;host=localhost;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );

    $ps = $pdo->prepare( 'SELECT * FROM cliente' );
    $ps->execute();
    $clientes = $ps->fetchAll();

    echo <<<'HTML'
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Transferência</title>
        </head>
        <body>
        <table>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Saldo (R$)</td>
                </tr>
                <tbody>
    HTML;

    foreach ( $clientes as $c ) {
        echo <<<HTML
                <tr>
                    <td>$c[id]</td>
                    <td>$c[nome]</td>
                    <td>$c[saldo]</td>
                </tr>
        HTML;
    }

    echo <<<'HTML'
                </tbody>
            </table>
        </body>
    </html>
    HTML;
}
?>