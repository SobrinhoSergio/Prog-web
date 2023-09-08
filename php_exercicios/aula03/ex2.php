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

$teste = [
    '30044000',
    '2225271727',
    '22987654321',
    '08007024000',
    'errado',
    'A08007024000'
];

foreach ( $teste as $t ) {
    echo formatarTelefone( $t ), PHP_EOL;
}

?>