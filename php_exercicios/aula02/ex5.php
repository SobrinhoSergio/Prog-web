<?php
    $pessoas = [];

    function exibirMenu(){
        echo "Escolha uma opcao: \n";
        echo "1 - Cadastrar pessoa\n"; 
        echo "2 - Remover pessoa\n";
        echo "3 - Listar pessoas\n";
        echo "4 - Sair\n";
    }

    function adicionarPessoa(&$pessoas){
        $nome = readline('Digite o nome: ');
        $idade = readline('Digite a idade: ');
        $pessoas []= ['nome' => $nome, 'idade' => $idade];
    }

    function removerPessoa(&$pessoas){
        $nome = readline("Digite o nome da pessoa: ");
        foreach($pessoas as $i => $valor){
            if($nome == $valor['nome']){
                unset($pessoas[$i]);
                $pessoas = array_values($pessoas);
            break;
            }
        }
    }

    function exibirPessoas(&$pessoas){
        echo "Pessoas: \n";
        usort($pessoas, function($a1,$a2){
        if($a1['nome'] == $a2['nome']) {return 0;}
        else if($a1['nome'] > $a2['nome']) {return 1;}
            return -1;
        });
        foreach($pessoas as $i => $valor){
            echo 'Nome: ', $valor['nome'],"   ", 'Idade: ', $valor['idade'], PHP_EOL;
        }
    }

    do{
        exibirMenu();
        $opcao = readline("");
        switch($opcao){
            case '1':
                adicionarPessoa($pessoas);
            break;
            case '2':
                removerPessoa($pessoas);
            break;
            case '3':
                exibirPessoas($pessoas);
            break;
        }
    } while($opcao != '4')
?>