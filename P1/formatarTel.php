<?php

function formatarTelefone2($telefone){

    $tamanho = mb_strlen($telefone);

    $v = '';

    if(($tamanho === 10 || $tamanho === 11) && is_numeric($telefone)){
        if($tamanho === 10){
            $v = "(" . mb_substr($telefone, 0, 2) . ") " . mb_substr($telefone, 2, 4) . "-" . mb_substr($telefone, 6);
            
            return $v;
        }

        else{
            $v = "(" . mb_substr($telefone, 0, 2) . ") " . mb_substr($telefone, 2, 5) . "-" . mb_substr($telefone, 7);
            
            return $v;
        }
    }

    return v;

}

$telefone = readline("Digite: ");

echo formatarTelefone2($telefone);