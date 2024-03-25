<?php

$contatos = [];

const opcao_sair = 0;
const opcao_listar = 1;
const opcao_cadastrar = 2;
const opcao_remover = 3;
const opcao_alterar = 4;


do{
    echo "Menu", PHP_EOL;
    desenharLinha();
    echo "0) Sair", PHP_EOL;
    echo "1) Listar", PHP_EOL;
    echo "2) Cadastrar", PHP_EOL;
    echo "3) Remover", PHP_EOL;
    echo "4) Alterar", PHP_EOL;

    desenharLinha();

    $opcao = readline("Opção: ");

    switch($opcao){
        case opcao_sair: break;
        case opcao_listar: listar($contatos); break;
        case opcao_cadastrar: cadastrar($contatos); break;
        case opcao_remover: remover($contatos); break;
        case opcao_alterar: alterar($contatos); break;
        default: echo 'Opção inválida.', PHP_EOL;
    }

}while($opcao != '0');


function cadastrar(&$contatos){
    echo 'Cadastro', PHP_EOL;
    desenharLinha();
    $nome= readline("Nome: ");
    $telefone = readline("Telefone: ");
    desenharLinha();
    $c = ['nome' => $nome, 'telefone' => $telefone];
    $contatos []= $c;
}

function listar($contatos){
    echo "Listagem", PHP_EOL;
    desenharLinha();
    foreach($contatos as $indice => $c){
        echo $indice + 1, ') ', $c['nome'], '-', $c['telefone'], PHP_EOL;
    }
    desenharLinha();
}

function desenharLinha(){
    echo str_repeat('-', 20), PHP_EOL;
}

function remover(&$contatos){
    echo "Remoção", PHP_EOL;
    desenharLinha();
    $posicao = readline('Posição a remover: ');
    if (is_numeric($posicao) && array_key_exists($posicao - 1, $contatos)){
        unset($contatos[$posicao - 1]);
        echo "Removido", PHP_EOL;
    }
    else{
        echo "Posição inválido", PHP_EOL;
    }
}

function alterar(&$contatos){
    echo "Alterar", PHP_EOL;
    $posicao = readline("Qual contato deseja alterar: ");
    $nomeNovo = readline("Nome novo: ");
    $telefoneNovo = readline("Telefone novo: ");

    if (is_numeric($posicao) && array_key_exists($posicao - 1, $contatos)){
        $contatos[$posicao-1]['nome'] = $nomeNovo;
        $contatos[$posicao-1]['telefone'] = $telefoneNovo;

    }
}