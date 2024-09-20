<?php
require_once 'conexao.php';
require_once 'RepositorioGame.php';

function retornarEmHtml() {
    include_once 'listagem.php';
}

function retornarEmJson() {
    $repositorio = new RepositorioGame( conectar() );
    $games = $repositorio->obterTodos();
    header( 'Content-Type: application/json' );
    echo json_encode( $games );
}

function cadastrarGame( array $dados ) {
    $game = new Game(
        0,
        isset( $dados[ 'nome' ] )   ? $dados[ 'nome' ]   : '',
        isset( $dados[ 'genero' ] ) ? $dados[ 'genero' ] : '',
        isset( $dados[ 'ano' ] )    ? $dados[ 'ano' ]    : ''
    );
    $repositorio = new RepositorioGame( conectar() );
    $repositorio->adicionar( $game );
    http_response_code( 201 ); // Created
    echo 'Cadastrado';
}

?>