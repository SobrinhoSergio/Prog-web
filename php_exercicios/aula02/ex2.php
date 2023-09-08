<?php
    $nomes = [];

    do{
        $opcao = readline("Escolha uma opcao: 1-Iserir  2-Excluir 3-Listar 4-Sair  ");
        switch($opcao){
            case '1':
                $nome = readline('Digite um nome: ');
                $nomes []= $nome;
            break;
            case '2':
                if(empty($nomes)){
                    echo 'Nenhum nome a ser removido', PHP_EOL;
                break;
                }
                $nome = readline('Digite um nome: ');
                $i = array_search($nome, $nomes);
                if($i === false){
                    echo 'Nome não encontrado', PHP_EOL;
                } else {
                    unset($nomes[$i]);
                    echo 'Removido com sucesso', PHP_EOL;
                }
            break;
            case '3':
                echo 'Nomes: \n';
                foreach($nomes as $i => $valor){
                    echo $i, '-', $valor, PHP_EOL;
                }
            break;
        }
    } while($opcao != '4')
    
?>
