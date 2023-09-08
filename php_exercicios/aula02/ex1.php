<?php
    $nomes = [];
    do{
        $nome = readline('Digite um nome (vazio para sair): ');
        $vazio = empty($nome);
        if(! $vazio){
            $nomes []= $nome;
        }
    } while(! $vazio);

    //exercício 1
    foreach($nomes as $i => $valor){
        echo $i, '-', $valor, PHP_EOL;
    }
?>
