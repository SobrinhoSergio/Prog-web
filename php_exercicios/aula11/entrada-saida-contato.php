<?php
function obterDadosContatos(){
    $tipoConteudo = getallheaders()['Content-Type'];
    $dadosContatos = [];
    if($tipoConteudo == 'application/x-www-form-urlencoded'){
        $dadosContatos = $_POST;
    }else if($tipoConteudo == 'application/json'){
        $texto = file_get_contents('php://input');
        $dadosContatos = (array) json_decode($texto);
    }
    return $dadosContatos;
}

function validarDados($dadosContatos){
    if(!array_key_exists('nome', $dadosContatos) 
    || !array_key_exists('telefone', $dadosContatos)){
        http_response_code(400);
        echo 'Por favor informe nome e telefone';
        die();
    }
}

function contatoNaoEncontrado(){
    http_response_code(404); //not found
    header('Content-type: text/plain');
    echo 'Contato não encontrado';
}
?>