<?php

$expressao = '/^([0-2][0-9]|3[01])|\/(0[1-9]|1[0-2])\/(20[0-2][0-4])|([01][0-9][0-9][0-9])$/';
$valor = '(22) 927453122';

if(preg_match($expressao, $valor, $casamentos)){
    echo 'Casou ', PHP_EOL;
    print_r($casamentos);
}
else{
    echo 'Não casou';
}


