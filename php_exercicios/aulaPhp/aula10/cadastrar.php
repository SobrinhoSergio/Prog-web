<?php

$descricao = htmlspecialchars( $_POST[ 'descricao' ] );
$validade = htmlspecialchars( $_POST[ 'validade' ] );
$estoque = htmlspecialchars( $_POST[ 'estoque' ] );

if ( ! preg_match( '/^[A-Z][A-Za-z ]{1,99}$/', $descricao ) ) {
    die( 'Descrição deve ter de 2 a 100 caracteres e começar com letra maiúscula.' );
}

if ( ! preg_match( '/^(01|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/', $validade ) ) {
    die( 'Validade deve estar no formato "dd/mm/aaaa"' );
} else {
    [ $dia, $mes, $ano ] = explode( '/', $validade );
    if ( ! checkdate( $mes, $dia, $ano ) ) {
        die( 'Validade é uma data inválida.' );
    }
}

if ( ! preg_match( '/^-?[0-9]+$/', $estoque ) ) {
    die( 'Estoque é um número inválido.' );
}

die( 'Salvo com sucesso' );

