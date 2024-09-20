<?php
require_once 'Conta.php';

interface RepositorioConta {

    function adicionar(Conta $conta);

    function remover($id);

    function atualizar(Conta $conta);
}