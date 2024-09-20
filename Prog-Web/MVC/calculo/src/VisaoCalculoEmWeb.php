<?php
require_once 'VisaoCalculo.php';

class VisaoCalculoEmWeb implements VisaoCalculo {

    // Entradas

    function numero1(): string {
        if ( ! isset( $_GET[ 'n1' ] ) ) {
            return '0';
        }
        return $_GET[ 'n1' ];
    }

    function numero2(): string {
        if ( ! isset( $_GET[ 'n2' ] ) ) {
            return '0';
        }
        return $_GET[ 'n2' ];
    }

    function operacao(): string {
        if ( ! isset( $_GET[ 'op' ] ) ) {
            return '';
        }
        return $_GET[ 'op' ];
    }

    // Saídas

    function mostrarResultado( $resultado ): void {
        echo 'Resultado: ', $resultado, PHP_EOL;
    }

    function mostrarExcecao( Exception $e ): void {
        echo 'Erro: ', $e->getMessage(), PHP_EOL;
    }

}