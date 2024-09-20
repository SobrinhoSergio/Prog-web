<?php
require_once 'ControladoraRemocao.php';
require_once 'VisaoRemocaoWeb.php';

$url = $_SERVER[ 'REQUEST_URI' ];
$metodo = $_SERVER[ 'REQUEST_METHOD' ];

if ( $metodo === 'DELETE' && mb_strpos( $url, '/autores/' ) !== false ) {
    $c = new ControladoraRemocao( new VisaoRemocaoWeb() );
    $c->remover();
} else {
    http_response_code( 404 );
    die( 'Não encontrado.' );
}