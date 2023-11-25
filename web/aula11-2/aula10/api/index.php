<?php
require_once 'src/operacoes.php';

$url = $_SERVER[ 'REQUEST_URI' ];
$metodo = $_SERVER[ 'REQUEST_METHOD' ];

if ( $metodo === 'GET' &&
    preg_match( '/^\/games\/?$/i', $url )
) {
    $cabecalhos = getallheaders();
    $formato = isset( $cabecalhos[ 'Accept' ] )
        ? $cabecalhos[ 'Accept' ]
        : 'text/html';
    if ( $formato == 'application/json' ) {
        retornarEmJson();
    } else {
        retornarEmHtml();
    }
} else if ( $metodo === 'POST' &&
    preg_match( '/^\/games\/?$/i', $url )
) {
    cadastrarGame( $_POST );
}
?>