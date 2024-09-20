<?php
require_once 'VisaoRemocao.php';

class VisaoRemocaoCLI implements VisaoRemocao {
    public function idARemover(): string {
        return readline( 'Digite o id do autor a remover: ' );
    }
    public function indicarSucesso() {
        die( 'Removido com sucesso' );
    }
    public function indicarEntradaInvalida() {
        die( 'O id deve ser um número.' );
    }
    public function indicarNaoEncontrado() {
        die( 'Autor não encontrado.' );
    }
    public function indicarErroAoRemover() {
        die( 'Erro ao remover o autor.' );
    }
}