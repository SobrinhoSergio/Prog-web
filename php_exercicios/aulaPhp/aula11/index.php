<?php
require_once 'contato.php';

// var_dump( $_SERVER );
$metodo = $_SERVER[ 'REQUEST_METHOD' ];
$url = str_replace(  // "/projeto1/contatos" => "/contatos"
    dirname( $_SERVER[ 'PHP_SELF' ] ), // "/projeto1"
    '',
    $_SERVER[ 'REQUEST_URI' ]
);
$casamentos = [];

if ( $metodo == 'GET' && preg_match( '/^\/contatos\/?$/i', $url ) ) {
    obterContatos();

} else if ( $metodo == 'GET' &&
    preg_match( '/^\/contatos\/([0-9]+)\/?$/i', $url, $casamentos ) ) {

    [ , $id ] = $casamentos; // Obtém o segundo elemento e coloca em $id
    obterContatoComId( $id );

} else if ( $metodo == 'DELETE' &&
preg_match( '/^\/contatos\/([0-9]+)\/?$/i', $url, $casamentos ) ) {
    [ , $id ] = $casamentos; // Obtém o segundo elemento e coloca em $id
    removerContatoComId( $id );

} else if ( $metodo == 'POST' && preg_match( '/^\/contatos\/?$/i', $url ) ) {
    cadastrarContato();

} else if ( $metodo == 'PUT' &&
    preg_match( '/^\/contatos\/([0-9]+)\/?$/i', $url, $casamentos )
) {
    [ , $id ] = $casamentos;
    alterarContatoComId( $id );
}
?>