<?php

$expressao = '/^([0-9]{2}|(\([0-9]{2}\)))? ?9[0-9]{4}-?[0-9]{4}$/';
$valor = '(22) 927453122';

if(preg_match($expressao, $valor, $casamentos)){
    echo 'Casou ', PHP_EOL;
    print_r($casamentos);
}
else{
    echo 'Não casou';
}


