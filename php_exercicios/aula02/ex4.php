<?php
    $pessoas = [];

    do{
        echo "Escolha uma opcao: \n 1-Cadastrar pessoa \n 2-Remover pessoa \n 3-Listar pessoas \n 4-Sair \n";
        $opcao = readline("");
        switch($opcao){
            case '1':
                $nome = readline('Digite o nome: ');
                $idade = readline('Digite a idade: ');
                $pessoas []= ['nome' => $nome, 'idade' => $idade];
            break;
            case '2':
                $nome = readline("Digite o nome da pessoa: ");
                foreach($pessoas as $i => $valor){
                    if($nome == $valor['nome']){
                        unset($pessoas[$i]);
                        $pessoas = array_values($pessoas);
                    break;
                    }
                }
                
            break;
            case '3':
                echo "Pessoas: \n";
                usort($pessoas, function($a1,$a2){
                    if($a1['nome'] == $a2['nome']) {return 0;}
                    else if($a1['nome'] > $a2['nome']) {return 1;}
                    return -1;
                });
                foreach($pessoas as $i => $valor){
                    echo 'Nome: ', $valor['nome'],"   ", 'Idade: ', $valor['idade'], PHP_EOL;
                }
            break;
        }
    } while($opcao != '4')
?>