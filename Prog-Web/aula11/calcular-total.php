<?php

require_once 'conta/fabrica-conta.php';
require_once 'log.php';

/**
 * Calcula e retorna o saldo total.
 * 
 * @return double
 */

/*function calcularTotal() {
    
    $repositorio = criarRepositorioConta();
    
    if ($repositorio === null) {
        return 0;
    }

    $contas = [];
    
    try {
        $contas = $repositorio->obterTodos();
    } catch (Exception $e) {
        logar($e);
        return 0;
    }

    $total = 0;
    
    foreach ($contas as $c) {
        $total += floatval($c->valor);
    }

    return number_format($total, 2, ',', '.');
}*/


// Função para calcular o total das contas

function calcularTotal() {
    try {

        $repositorio = criarRepositorioConta();
        
        $total = $repositorio->calcularSaldoTotal();
        
        return number_format($total, 2, ',', '.');
        
    } catch (Exception $e) {
        logar($e);
        return '0,00';
    }
}
