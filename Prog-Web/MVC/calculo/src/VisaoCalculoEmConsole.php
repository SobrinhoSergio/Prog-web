<?php
require_once 'VisaoCalculo.php';

class VisaoCalculoEmConsole implements VisaoCalculo {

    // Entradas

    function numero1(): string {
        return readline( 'Número 1: ' );
    }

    function numero2(): string {
        return readline( 'Número 2: ' );
    }

    function operacao(): string {
        return readline( 'Operação (somar ou dividir):' );
    }

    // Saídas

    function mostrarResultado( $resultado ): void {
        echo 'Resultado: ', $resultado, PHP_EOL;
    }

    function mostrarExcecao( Exception $e ): void {
        echo 'Erro: ', $e->getMessage(), PHP_EOL;
    }

}