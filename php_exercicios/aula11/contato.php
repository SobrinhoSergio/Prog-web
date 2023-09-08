<?php
require_once 'armazenamento-contato.php';
require_once 'entrada-saida-contato.php';

function obterContatos(){
    $contatos = carregarContatos();
        header('Content-type: application/json');
        echo json_encode($contatos);
}

function obterContatoComId($id){
    header('Content-type: application/json');
        $contatos = carregarContatos();
        $achou = false;
        foreach($contatos as $c){
            if($c->id == $id){
                echo json_encode($c);
                $achou = true;
            break;
            }
        }
        if(!$achou){
            contatoNaoEncontrado();
        }
}

function removerContatoComId($id){
    http_response_code(204);
        $contatos = carregarContatos();
        $achou = false;
        foreach($contatos as $indice => $c){
            if($c->id == $id){
                unset($contatos[$indice]);
                salvarContatos($contatos);
                $achou = true;
            break;
            }
        }
        if(!$achou){
            contatoNaoEncontrado();
        }
}

function cadastrarContato(){
    $dadosContatos = obterDadosContatos();
        validarDados($dadosContatos);

        $contatos = carregarContatos();
        $dadosContatos['id'] = gerarId($contatos);
        $contato = (object) $dadosContatos;
        $contatos []= $contato;
        salvarContatos($contatos);
        http_response_code(201);
        echo 'Salvo com sucesso';
}

function alterarContatoComId($id){
    $contatos = carregarContatos();
        $achou = false;
        foreach($contatos as $indice => $c){
            if($c->id == $id){
                $dadosContatos = obterDadosContatos();
                validarDados($dadosContatos);
                $dadosContatos['id'] = $id;
                $contatos[$indice] = (object) $dadosContatos;
                salvarContatos($contatos);
                $achou = true;
            break;
            }
        }
        if(!$achou){
            contatoNaoEncontrado();
        }
}
?>