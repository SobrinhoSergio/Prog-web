<?php
function formatarTelefone( $telefone ) {
    $tamanho = mb_strlen( $telefone );
    if ( $tamanho == 8 ) { // 30044000 -> 3004 400
        return mb_substr( $telefone, 0, 4 ) . ' ' .
                mb_substr( $telefone, 4 );
    } else if ( $tamanho == 10 ) { // 2225271727 -> (22) 2527-1727
        return '(' . mb_substr( $telefone, 0, 2 ) . ') ' .
                mb_substr( $telefone, 2, 4 ) . '-' .
                mb_substr( $telefone, 6 );
    } else if ( $tamanho == 11 ) {
        $prefixo = mb_substr( $telefone, 0, 4 );
        // 08007024000  -> 0800 702 4000
        if ( $prefixo === '0800' || $prefixo === '0300' ) {
            return mb_substr( $telefone, 0, 4 ) . ' ' .
                mb_substr( $telefone, 4, 3 ) . ' ' .
                mb_substr( $telefone, 7 );
        } else {
            // 22987654321 -> (22) 9-8765-4321
            return '(' . mb_substr( $telefone, 0, 2 ) . ') ' .
                mb_substr( $telefone, 2, 1 ) . '-' .
                mb_substr( $telefone, 3, 4 ) . '-' .
                mb_substr( $telefone, 7 );
        }
    }
    return $telefone;
}

// echo formatarTelefone( '229876543210' );

?>