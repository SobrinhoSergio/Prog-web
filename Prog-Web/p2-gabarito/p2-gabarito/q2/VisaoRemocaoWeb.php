<?php
require_once 'VisaoRemocao.php';

class VisaoRemocaoWeb implements VisaoRemocao {
    public function idARemover(): string {
        $partes = explode( '/', $_SERVER[ 'REQUEST_URI' ] );
        return $partes[ count( $partes ) - 1 ]; // última parte
    }

    public function indicarSucesso() {
        http_response_code( 204 );
        die();
    }

    public function indicarEntradaInvalida() {
        http_response_code( 400 );
        die( 'O id deve ser um número.' );
    }

    public function indicarNaoEncontrado() {
        http_response_code( 404 );
        die( 'Autor não encontrado.' );
    }

    public function indicarErroAoRemover() {
        http_response_code( 500 );
        die( 'Erro ao remover o autor.' );
    }
}