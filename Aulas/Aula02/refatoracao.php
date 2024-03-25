<?php

$contatos = [];

const opcao_sair = 0;
const opcao_listar = 1;
const opcao_cadastrar = 2;
const opcao_remover = 3;
const opcao_alterar = 4;
const opcao_salvar = 5;
const opcao_carregar = 6;

do{
    echo "Menu", PHP_EOL;
    desenharLinha();
    echo "0) Sair", PHP_EOL;
    echo "1) Listar", PHP_EOL;
    echo "2) Cadastrar", PHP_EOL;
    echo "3) Remover", PHP_EOL;
    echo "4) Alterar", PHP_EOL;
    echo "5) Salvar para arquivo", PHP_EOL;
    echo "6) Carregar para arquivo", PHP_EOL;


    desenharLinha();

    $opcao = readline("Opção: ");

    switch($opcao){
        case opcao_sair: break;
        case opcao_listar: listar($contatos); break;
        case opcao_cadastrar: cadastrar($contatos); break;
        case opcao_remover: remover($contatos); break;
        case opcao_alterar: alterar($contatos); break;
        case opcao_salvar: salvarParaArquivo($contatos); break;
        case opcao_carregar: $contatos = carregarDeArquivo($contatos); break;

        default: echo 'Opção inválida.', PHP_EOL;
    }

}while($opcao != '0');


function cadastrar(&$contatos){
    echo 'Cadastro', PHP_EOL;
    desenharLinha();

    if(mb_strlen($nome)>=2 && mb_strlen($nome)<=10){
        return;
    }
    if(mb_strlen($telefone)<=10){
        return;
    }
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
    $posicao = solicitarPosicao($contatos);

    $nomeNovo = readline("Nome novo: ");
    $telefoneNovo = readline("Telefone novo: ");

    if ($posicao >= 0){
        $contatos[$posicao-1]['nome'] = $nomeNovo;
        $contatos[$posicao-1]['telefone'] = $telefoneNovo;

    }
}

function solicitarPosicao($contatos){
    $posicao = readline("Posição a alterar (1-n): ");
    if (is_numeric($posicao) && array_key_exists($posicao - 1, $contatos)){
        return (int) $posicao - 1;
    }
    
    return -1;

}

function salvarParaArquivo($contatos){
    $json = json_encode($contatos); //gera strings
    file_put_contents('contatos.json', $json);
    echo "Salvo com Sucesso!", PHP_EOL;
}

function carregarDeArquivo($contatos){
    $json = file_put_contents('contatos.json');
    echo "Carregado com Sucesso!", PHP_EOL;
    return json_decode($json, true); //Transforma em matriz
}

function validacaoNome($contatos){
    if(mb_strlen($nome)>=2 && mb_strlen($nome)<=10){
        return;
    }
}

function validacaoTelefone($contatos){
    if(mb_strlen($telefone)<=10){
        return;
    }
}