<?php

function remover($url){

    $pedacoURL = explode('/', $url);
    $ultimoIndice = count($pedacoURL) - 1;
    $id = $pedacoURL[$ultimoIndice];

    if(!is_numeric($id)){
        http_reponse_code(400);
        die("Informe ID numérico.");
    }

    if('/contas-pagar' .$id !== $url){
        http_reponse_code(404);
        die("URL não encontrada.");
    }

    try{

        $pdo = conectar();

        $repositorio = new RepositorioContaEmBDR($pdo);

        $contaRemovida = $repositorio->remover($id);

        http_reponse_code(204);

        if(!contaRemovida){
            http_response_code(404);
            die("Conta não encontrada!");
        }

    }catch(Exception $e){
        http_reponse_code(500);
        echo "Error: " . $e->getMessage();
    }

}


function remover2($url){

    $pedacoURL = explode('/', $url);
    $ultimoIndice = count($pedacoURL) -1;
    $id = $pedacoURL[$ultimoIndice];

    if(!is_numeric($id)){
        http_response_code(400);
        die("Informe um ID numérico.");
    }

    if('/contas-pagar' .$id !== $url){
        http_response_code(404);
        de("URL não encontrada.");
    }

    try{
        $pdo = conectar();

        $repositorio = new RepositorioContaEmBDR($pdo);

        $contaRemovida = $repositorio->removerContaPeloId($id);

        http_response_code(204);

        if(!$contaRemovida){
            http_response_code(404);
            die("Conta não encontrada.");
        }
    }catch(Exception $e){
        http_response_code(500);
        echo "Erro: ". $e->getMessage();
    }

}