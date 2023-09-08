<?php
require_once 'armazenamento-contato.php';
require_once 'entrada-saida-contato.php';

function obterContatos() {
    header( 'Content-Type: application/json' );
    $contatos = carregarContatos();
    echo json_encode( $contatos );
}

function obterContatoComId( $id ) {
    header( 'Content-Type: application/json' );
    $contatos = carregarContatos();
    $achou = false;
    foreach ( $contatos as $c ) {
        if ( $c->id == $id ) {
            echo json_encode( $c );
            $achou = true;
            break;
        }
    }
    if ( ! $achou ) {
        indicarContatoNaoEncontrado();
    }
}

function removerContatoComId( $id ) {
    http_response_code( 204 ); // No Content
    $contatos = carregarContatos();
    $achou = false;
    foreach ( $contatos as $indice => $c ) {
        if ( $c->id == $id ) {
            unset( $contatos[ $indice ] );
            salvarContatos( $contatos );
            $achou = true;
            break;
        }
    }
    if ( ! $achou ) {
        indicarContatoNaoEncontrado();
    }
}

function cadastrarContato() {
    // var_dump( getallheaders() );
    // echo file_get_contents( 'php://input' );
    $dadosContato = obterDadosContato();
    validarDadosContato( $dadosContato );

    $contatos = carregarContatos();
    $dadosContato[ 'id' ] = gerarId( $contatos );
    $contato = (object) $dadosContato;
    $contatos []= $contato; // array_push( $contatos, $contato );
    salvarContatos( $contatos );
    http_response_code( 201 ); // Created
    echo 'Salvo com sucesso.';
}


function alterarContatoComId( $id ) {
    $contatos = carregarContatos();
    $achou = false;
    foreach ( $contatos as $indice => $c ) {
        if ( $c->id == $id ) {
            $dadosContato = obterDadosContato();
            validarDadosContato( $dadosContato );
            $dadosContato[ 'id' ] = $id;
            $contatos[ $indice ] = (object) $dadosContato;
            salvarContatos( $contatos );
            $achou = true;
            break;
        }
    }
    if ( ! $achou ) {
        indicarContatoNaoEncontrado();
    }
}

?>