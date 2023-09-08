<?php
// EXERCÍCIO 1
// Crie uma função dataPorExtenso() que receba uma data no formato
// "dd/mm/aaaa" e retorne a data com o mês por extenso. Por exemplo,
// "17/03/2023" deve retornar 17 de Março de 2023

// function dataPorExtenso1( $data ) {
//     $partes = explode( '/', $data ); // [ 0 => '17', 1 => '03', 2 => '2023' ]
//     $mes = $partes[ 1 ];
//     $extenso = '';
//     switch ( $mes ) {
//         case '01':
//         case '1' : $extenso = 'Janeiro'; break;
//         case '02':
//         case '2' : $extenso = 'Fevereiro'; break;
//         case '03':
//         case '3' : $extenso = 'Março'; break;
//         // ...
//         default: $extenso = '???';
//     }
//     return $partes[ 0 ] . ' de ' . $extenso . ' de ' . $partes[ 2 ];
// }

function dataPorExtenso( $data ) {
        $partes = explode( '/', $data ); // [ 0 => '17', 1 => '03', 2 => '2023' ]

        $meses = [ 1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ];

        $mes = (int) $partes[ 1 ]; // '03' => 3

        return $partes[ 0 ] . ' de ' . $meses[ $mes ] . ' de ' . $partes[ 2 ];
    }

echo dataPorExtenso( '17/03/2023' );

?>