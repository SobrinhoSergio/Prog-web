<?php

require_once 'conta/fabrica-conta.php';
require_once 'log.php';

/**
 * Retorna as linhas da tabela com os dados das contas.
 * 
 * @return string
 */

 
function gerarLinhas() {    
    
    $repositorio = criarRepositorioConta();
    
    if ( $repositorio === null ) {
        return '';
    }

    $contas = [];

    try {
        $contas = $repositorio->obterTodos();
    } catch ( Exception $e ) {
        logar( $e );
        return '';
    }

    $linhas  = '';

    foreach ( $contas as $c ) {
        
        // Ex. [ 2024, 7, 4 ]
        
        [ $ano, $mes, $dia ] = explode( '-', $c->vencimento );
        
        $vencimento = "$dia/$mes/$ano";

        $paga = $c->paga ? 'Sim' : 'Não';

        $valor = str_replace( '.', ',', $c->valor );

        $linhas .= <<<HTML
            <tr>
                <td>{$c->id}</td>
                <td>{$c->descricao}</td>
                <td>{$c->tipo}</td>
                <td>{$vencimento}</td>
                <td>{$paga}</td>
                <td>{$valor}</td>
                <td><a href="remover.php?id={$c->id}" >Remover</a></td>
            </tr>
        HTML;
    }
    return $linhas;
}
