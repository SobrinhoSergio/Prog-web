<?php

require_once 'DominioException.php';

class visaoConta{

    function dadosConta(){
        return $_POST;
    }

    function mostrarCadastradoComSucesso(){
        http_response_code(201);
        die('Salvo com Sucesso!');
    }

    function mostrarRemovidoComSucesso(){
        http_response_code(204);
        die('Removido com Sucesso!');
    }

    function mostrarAtualizadoComSucesso(){
        http_response_code(201);
        die('Editado com Sucesso!');
    }

    function mostrarExecao(Exception $e){
        if($e instanceof DominioException){
            http_response_code(400);
        }
        else{
            http_reponse_code(500);
        }
        die($e->getMessage());
    }
}