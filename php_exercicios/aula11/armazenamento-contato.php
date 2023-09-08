<?php
function carregarContatos(){
    $conteudo = file_get_contents('api.json');
    $objeto = json_decode($conteudo);
    return $objeto->contatos;
}

function salvarContatos($contatos){
    $objeto = new stdClass();
    $objeto->contatos = $contatos;
    $texto = json_encode($objeto);
    file_put_contents('api.json', $texto);
}

function gerarId($contatos){
    $maior = 0;
    foreach($contatos as $c){
        if($c->id > $maior){
            $maior = $c->id;
        }
    }
    return $maior + 1;
}

?>