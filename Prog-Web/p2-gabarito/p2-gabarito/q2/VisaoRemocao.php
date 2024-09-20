<?php
interface VisaoRemocao {
    public function idARemover(): string;
    public function indicarSucesso();
    public function indicarEntradaInvalida();
    public function indicarNaoEncontrado();
    public function indicarErroAoRemover();
}