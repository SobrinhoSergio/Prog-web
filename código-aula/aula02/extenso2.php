<?php
// Exercício: Crie uma função chamada "extenso" que
// receba um dia, um mês e um ano e retorne no formato
// equivalente ao abaixo:
//  29 de Fevereiro de 2024
function extenso( $dia, $mes, $ano ) {
    $meses = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        // ...
    ];
    if ( ! isset( $meses[ $mes ] ) ) {
        return $dia . ' de ??? de ' . $ano;
    }
    return $dia . ' de ' . $meses[ $mes ] . ' de ' . $ano;
}

echo extenso( 29, 3, 2024 );
?>