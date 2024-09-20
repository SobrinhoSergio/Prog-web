<?php
require_once 'VisaoRemocao.php';
require_once 'GestorRemocao.php';
require_once 'RepositorioAutorEmBDR.php';
require_once '../conexao.php';

class ControladoraRemocao {
    private $visao;

    public function __construct( VisaoRemocao $visao ) {
        $this->visao = $visao;
    }

    public function remover() {
        $id = $this->visao->idARemover();
        try {
            $repositorio = new RepositorioAutorEmBDR( conectar() );
            $gestor = new GestorRemocao( $repositorio );
            $gestor->remover( $id );
            $this->visao->indicarSucesso();
        } catch ( NaoEncontradoException $e ) {
            $this->visao->indicarNaoEncontrado();
        } catch ( DominioException $e ) {
            $this->visao->indicarEntradaInvalida();
        } catch ( Exception $e ) {
            $this->visao->indicarErroAoRemover();
        }
    }
}