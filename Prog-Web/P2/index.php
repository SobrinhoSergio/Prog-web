<?php

require_once 'entrada-saida.php';

$metodo = $_SERVER['REQUEST_METHOD'];

$url = str_replace(dirname($_SERVER['PHP_SELF']), '', $_SERVER['REQUEST_URI']);

$casamentos = [];

if($metodo == 'GET' && preg_match('/^\/fornecedores(\/filtro=.*)?\/?$/i', $url)){
    consultarFornecedores();
}

else if($metodo == 'POST' && preg_match('/^\/fornecedores\/?\/?$/i', $url)){
    cadastrarFornecedores();
}

else if($metodo == 'PUT' && preg_match('/^\/fornecedores(\/[0-9+])?\/?$/i', $url, $casamento)){
    [, $id] = $casamento;
    atualizarFornecedores();
}

else if($metodo == 'DELET' && preg_match('/^\/fornecedores\/(.*)?$/i', $url, $casamento)){
    [, $idOuCodigo] = $casamento;
    removerFornecedores($idOuCodigo);
}