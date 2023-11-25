<?php
require_once 'src/transferencia.php';
require_once 'src/atualizacao.php';
require_once 'src/listagem.php';

$url = $_SERVER[ 'REQUEST_URI' ];
$metodo = $_SERVER[ 'REQUEST_METHOD' ];

if ( $metodo === 'POST' && preg_match( '/^\/transferencias\/?$/i', $url ) ) {
    $valor     = isset( $_POST[ 'valor' ] )      ? $_POST[ 'valor' ]      : 0;
    $origemId  = isset( $_POST[ 'origem_id' ] )  ? $_POST[ 'origem_id' ]  : 0;
    $destinoId = isset( $_POST[ 'destino_id' ] ) ? $_POST[ 'destino_id' ] : 0;

    $ok = transferir( $origemId, $destinoId, $valor );
    if ( $ok ) {
        http_response_code( 201 ); // Created
        echo 'Transferido.';
    } else {
        http_response_code( 500 ); // Internal Server Error
        echo 'Erro ao transferir os valores.';
    }
} else if ( $metodo === 'PUT' && // clientes/100
    preg_match( '/^\/clientes\/([0-9]+)\/?$/i', $url, $casamentos )
) {
    [ , $id ] = $casamentos; // list( , $id ) = $casamentos;
    // Pega os dados brutos da requisição como string
    $conteudo = file_get_contents( 'php://input' );
    $dados = [];
    mb_parse_str( $conteudo, $dados ); // Coloca no array
    $nome  = isset( $dados[ 'nome' ] )  ? $dados[ 'nome' ]  : '';
    $saldo = isset( $dados[ 'saldo' ] ) ? $dados[ 'saldo' ] : '';
    $ok = atualizarCliente( $id, $nome, $saldo );
    if ( $ok ) {
        http_response_code( 200 );
        die( 'Atualizado' );
    } else {
        http_response_code( 500 );
        die( 'Erro atualizando cliente ' . $id );
    }
} else if ( $metodo === 'GET' && preg_match( '/^\/clientes\/?$/i', $url ) ) {
    listarClientes();
}

?>