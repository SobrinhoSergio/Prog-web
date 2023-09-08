<?php

function formatarTelefone( $numero ) {

    if ( ! is_numeric( $numero ) ) {
        return $numero;
    }

    $tamanho = mb_strlen( $numero );
    if ( $tamanho === 8 ) { // 30044000
        $parte1 = mb_substr( $numero, 0, 4 ); // 3004
        $parte2 = mb_substr( $numero, 4 );    // 4000
        return $parte1  . ' ' . $parte2;
    } else if ( $tamanho === 10 ) { // 2225271727
        $parte1 = mb_substr( $numero, 0, 2 ); // 22
        $parte2 = mb_substr( $numero, 2, 4 ); // 2527
        $parte3 = mb_substr( $numero, 6 );    // 1727
        return "($parte1) $parte2-$parte3";
    } else if ( $tamanho === 11 ) { // 22987654321

        $prefixo = mb_substr( $numero, 0, 4 ); // 0800/0300
        if ( $prefixo === '0800' || $prefixo === '0300' ) { // 08007024000
            $parte2 = mb_substr( $numero, 4, 3 ); // 702
            $parte3 = mb_substr( $numero, 7 );    // 4000
            return "$prefixo $parte2 $parte3";
        }

        $parte1 = mb_substr( $numero, 0, 2 ); // 22
        $parte2 = mb_substr( $numero, 2, 1 ); // 9
        $parte3 = mb_substr( $numero, 3, 4 ); // 8765
        $parte4 = mb_substr( $numero, 7 );    // 4321
        return "($parte1) $parte2-$parte3-$parte4";
    }

    return $numero;
}

function formatarTodosOsTelefones( array &$telefones ) {
    foreach ( $telefones as &$t ) {
        $t = formatarTelefone( $t );
    }
}


$teste = [
    '30044000',
    '2225271727',
    '22987654321',
    '08007024000',
    'errado',
    '2225271727', // <<
    'A08007024000',
    '08007024000', // <<
];

function telefoneRepetidos( $telefones ) {
    $contagem = [];
    foreach ( $telefones as $t ) {
        $t = formatarTelefone( $t );
        if ( ! isset( $contagem[ $t ] ) ) { // [ '25271717' => 1 ]
            $contagem[ $t ] = 1;
        } else {
            $contagem[ $t ]++;
        }
    }
    
    $repetidos = [];
    foreach ( $contagem as $tel => $quantos ) {
        if ( $quantos > 1 ) {
            $repetidos []= $tel;
        }
    }
    return $repetidos;
}

$repetidos = telefoneRepetidos( $teste );
foreach ( $repetidos as $r ) {
    echo $r, PHP_EOL;
}

?>