<?php
require_once '../conexao.php';

if ( isset( $_POST[ 'nome' ], $_POST[ 'nascimento' ] ) ) {
    http_response_code( 400 );
    die( 'Por favor, envie "nome" e "nascimento".' );
}
$nome = htmlspecialchars( $_POST[ 'nome' ] );
$nascimento = htmlspecialchars( $_POST[ 'nascimento' ] );
if ( empty( $nome ) || mb_strlen( $nome ) > 80 ) {
    http_response_code( 400 );
    die( 'O nome deve ser preenchido e ter até 80 caracteres.' );
}
$nascimentoValido = false;
if ( mb_strlen( $nascimento ) === 10 ) {
    list( $dia, $mes, $ano ) = explode( '/', $nascimento );
    $nascimentoValido = checkdate( (int) $mes, (int) $dia, (int) $ano );
    $nascimento = "$mes-$dia-$ano"; // Para armazenar
}
if ( ! $nascimentoValido ) {
    http_response_code( 400 );
    die( 'O nascimento deve ser uma data válida (dd/mm/aaaa).' );
}

try {
    $pdo = conectar();
    $ps = $pdo->prepare( 'INSERT INTO autor (nome, nascimento) VALUES (:nome, :nascimento)' );
    $ps->execute( ['nome' => $nome, 'nascimento' => $nascimento] );
    http_response_code( 201 );
    die( 'Salvo' );
} catch ( Exception $e ) {
    http_response_code( 500 );
    die( 'Erro ao cadastrar o autor: ' . $e->getMessage() );
}