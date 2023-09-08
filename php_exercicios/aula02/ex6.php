<?php
    $pessoas = [];

    function exibirMenu(){
        echo "Escolha uma opcao: \n";
        echo "1 - Cadastrar pessoa\n"; 
        echo "2 - Remover pessoa\n";
        echo "3 - Listar pessoas\n";
        echo "4 - Alterar pessoa\n";
        echo "5 - Sair\n";
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
            echo $i," - ",'Nome: ', $valor['nome'],"   ", 'Idade: ', $valor['idade'], PHP_EOL;
        }
    }
    function alterarPessoa(&$pessoas){
        echo "Digite o indice da pessoa que deseja alterar: ";
        $i = readline("");
        $nome = readline('Digite o nome: ');
        $idade = readline('Digite a idade: ');
        $pessoas [$i]= ['nome' => $nome, 'idade' => $idade];
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
            case '4':
                alterarPessoa($pessoas);
            break;
        }
    } while($opcao != '5')
?>