<?php
require_once 'RepositorioAutor.php';

class DominioException extends RuntimeException {}
class NaoEncontradoException extends DominioException {}

class GestorRemocao {

    private $respositorio;

    public function __construct( RepositorioAutor $repositorio ) {
        $this->respositorio = $repositorio;
    }

    function remover( $id ) {
        if ( ! is_numeric( $id ) ) {
            throw new DominioException( 'Id inválido.' );
        }
        $ok = $this->respositorio->removerPeloId( $id );
        if ( ! $ok ) {
            throw new NaoEncontradoException( 'Autor não encontrado.' );
        }
    }
}