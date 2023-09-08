<?php
    $contato = new stdClass();
    $contato->nome = 'Ana';
    $contato->telefone = '12345678';

    var_dump($contato);

    //converter para Array
    $a = (array) $contato;
    echo $a['nome'], ' - ', $a['telefone'], PHP_EOL;

    $obj = (object) $a;
    echo $obj->nome, ' - ', $obj->telefone, PHP_EOL; 
?>