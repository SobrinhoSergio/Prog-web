<?php

$telefones = [
    '30044000',
    '2225271727',
    '08007024000',
    '22987654321',

    '30044000',

    '08007024000'
];

function telefoneRepetidos( $telefones ) {
    $contagem = []; // [ '30044000' => 1 ]
    foreach ( $telefones as $t ) {
        if ( isset( $contagem[ $t ] ) ) {
            $contagem[ $t ]++;
        } else {
            $contagem[ $t ] = 1;
        }
    }
    $repetidos = [];
    foreach ( $contagem as $telefone => $valor ) {
        if ( $valor > 1 ) {
            $repetidos []= $telefone;
        }
    }
    return $repetidos;
}


print_r( telefoneRepetidos( $telefones ) );