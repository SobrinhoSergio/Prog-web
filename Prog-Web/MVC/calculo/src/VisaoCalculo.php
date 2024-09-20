<?php
interface VisaoCalculo {

    // Entradas

    function numero1(): string;

    function numero2(): string;

    function operacao(): string;

    // Saídas

    function mostrarResultado( $resultado ): void;

    function mostrarExcecao( Exception $e ): void;
}