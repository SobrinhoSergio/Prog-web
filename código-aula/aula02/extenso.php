<?php
// Exercício: Crie uma função chamada "extenso" que
// receba um dia, um mês e um ano e retorne no formato
// equivalente ao abaixo:
//  29 de Fevereiro de 2024
function extenso( $dia, $mes, $ano ) {
    $mesPorExtenso = '';
    switch( $mes ) {
        case 1: $mesPorExtenso = 'Janeiro'; break;
        case 2: $mesPorExtenso = 'Fevereiro'; break;
        case 3: $mesPorExtenso = 'Março'; break;
        // ...
        default: $mesPorExtenso = '???';
    }
    return $dia . ' de ' . $mesPorExtenso . ' de ' . $ano;
}

echo extenso( 29, 2, 2024 );
?>