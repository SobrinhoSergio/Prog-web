<?php
    $nomes = [];

    do{
        echo "Escolha uma opcao: \n 1-Iserir \n 2-Excluir \n 3-Listar \n 4-Sair \n";
        $opcao = readline("");
        switch($opcao){
            case '1':
                $nome = readline('Digite um nome: ');
                $nomes []= $nome;
                require_once 'limparTela.php';
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
                require_once 'limparTela.php';
            break;
            case '3':
                sort($nomes);
                echo "Nomes: \n";
                foreach($nomes as $i => $valor){
                    echo $i, '-', $valor, PHP_EOL;
                }
                require_once 'limparTela.php';
            break;
        }
    } while($opcao != '4')
    
?>