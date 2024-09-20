<?php
require_once 'gerar-linhas.php';
require_once 'calcular-total.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Pagar e a Receber</title>
    <link rel="stylesheet" href="conta.css" />
</head>
<body>
    <header>
        <h1>Contas a Pagar e a Receber</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Vencimento</th>
                    <th>Paga ?</th>
                    <th>Valor (R$)</th>
                    <th>Remoção</th>
                </tr>
            </thead>
            <tbody>                
                <?php echo gerarLinhas(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" ></td>
                    <td><?php echo calcularTotal(); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>
</html>