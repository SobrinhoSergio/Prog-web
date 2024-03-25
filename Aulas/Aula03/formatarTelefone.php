<?php

function formatarTelefone($numero){

    if( !is_numeric($numero)){
        return $numero;
    }

    $tamanho = mb_strlen( $numero );

    if ($tamanho === 8){
        $parte1 = mb_substr($numero, 0, 4);
        $parte2 = mb_substr($numero, 4);
        return $parte1 .' '. $parte2;
    }
    else if($tamanho === 10){
        $parte1 = mb_substr($numero, 0, 2); // Ele primeiro pega o indice e depois a qtd a partir do indice
        $parte2 = mb_substr($numero, 2, 4);
        $parte3 = mb_substr($numero, 6);
        return "($parte1) $parte2-$parte3";

    }
    else if($tamanho === 11){
        $prefixo = mb_substr($numero, 0, 4);
        if ($prefixo === '0800' || $prefixo === '0300'){
            $parte2 = mb_substr($numero, 4, 3);
            $parte3 = mb_substr($numero, 7);
            return "$prefixo $parte2 $parte3";
        }

        $parte1 = mb_substr($numero, 0, 2);
        $parte2 = mb_substr($numero, 2, 1);
        $parte3 = mb_substr($numero, 3, 4);
        $parte4 = mb_substr($numero, 7);

        return "($parte1) $parte2-$parte3-$parte4";
    }
}

$num = readline("Digite um número válido: ");

echo formatarTelefone($num);

