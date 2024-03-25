<?php
require_once '01-telefone.php';

$telefones = [
    '30044000',
    '2225271727',
    '08007024000',
    '22987654321'
];

function formatarTodosOsTelefones( &$telefones ) {
    // foreach ( $telefones as &$t ) {
    //     $t = formatarTelefone( $t );
    // }
    foreach ( $telefones as $indice => $t ) {
        $telefones[ $indice ] = formatarTelefone( $t );
    }
}

formatarTodosOsTelefones( $telefones );
print_r( $telefones );