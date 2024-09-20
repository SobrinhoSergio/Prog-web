<?php

require_once "conta/conectar.php";
require_once 'conta/RepositorioContaEmBDR.php';
require_once 'conta/Conta.php';


function gerarLinhas(){

    $pdo = null;
    $contas = [];
    
    try{
        $pdo = conectar();

        $repositorio = new RepositorioContaEmBDR($pdo);
        $contas = $repositorio->obterTodos();
    
    }catch(PDOException $e){
        $conteudo = '['. ( new DateTime() )->format ('Y-m-d H:i:s'). ']'. $e->getMessage();
        file_put_contents('log.txt', $conteudo, FILE_APPEND);
        return '';
    }
    
    $linhas = '';


    foreach($contas as $c){
        [$ano, $mes, $ano] = $vencimento = explode('-', $c->vencimento);
        $vencimento = "$dia/$mes/$ano";

        $paga = $c->paga ? "Sim" : "Não";

        $valor = str_replace('.', ',', $c->valor);

        $linhas .= <<<HTML
            <tr>
                <td>{$c->id}</td>
                <td>{$c->descricao}</td>
                <td>{$c->tipo}</td>
                <td>{$vencimento}</td>
                <td>{$paga}</td>
                <td>{$valor}</td>
            </tr>
        HTML;
    }
    
    return $linhas;


}

function calcularTotal(){

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Paga e a Receber</title>
</head>
<body>
    <header>
        <h1>Contas a Paga e a Receber</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Descrição</td>
                    <td>Tipo</td>
                    <td>Vencimento</td>
                    <td>Paga?</td>
                    <td>Valor (R$)</td>
                </tr>
            </thead>

            <tbody>
                <?php echo gerarLinhas(); ?>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="5"></td>
                    <td><?php echo calcularTotal(); ?></td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>
</html>