<?php

require_once 'Produto.php';

interface RepositorioProduto {
    function cadastrar(Produto $produto);
    function editar(int $id, Produto $produto);
    function deletar(int $id);
    function listar();
}

?>
