<?php

function obterDadosContato() {
    $tipoConteudo = getallheaders()[ 'Content-Type' ];
    $dadosContato = [];
    if ( $tipoConteudo == 'application/x-www-form-urlencoded' ) {
        $dadosContato = $_POST;
    } else if ( $tipoConteudo == 'application/json' ) {
        $texto = file_get_contents( 'php://input' );
        $dadosContato = (array) json_decode( $texto );
    }

    return $dadosContato;
}

function validarDadosContato( &$dadosContato ) {
    // nome, telefone
    // if ( ! isset( $dadosContato['nome'], $dadosContato['telefone'] ) ) )
    if ( ! array_key_exists( 'nome', $dadosContato ) ||
        ! array_key_exists( 'telefone', $dadosContato )
    ) {
        http_response_code( 400 ); // Bad Content
        echo 'Por favor informe "nome" e "telefone".';
        die();
    }

    $dadosContato[ 'nome' ] = htmlspecialchars( $dadosContato[ 'nome' ] );
    $dadosContato[ 'telefone' ] = htmlspecialchars( $dadosContato[ 'telefone' ] );
}

function indicarContatoNaoEncontrado() {
    http_response_code( 404 ); // Not Found
    header( 'Content-Type: text/plain' );
    echo 'Contato não encontrado.';
}

?>