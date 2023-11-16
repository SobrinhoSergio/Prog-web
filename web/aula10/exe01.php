<?php

/*$expressao = '/^[0-9]{8}$/';
$valor = 28613001;*/

$expressao = '/^[0-9]{2}\.?[0-9]{3}-[0-9]{3}$/';
$valor = 28613001;

if(preg_match($expressao, $valor, $casamentos)){
    echo 'Casou ', PHP_EOL;
    print_r($casamentos);
}
else{
    echo 'Não casou';
}