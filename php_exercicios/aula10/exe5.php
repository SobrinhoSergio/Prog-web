<?php
    $regex = "/^([0-1]{1}[0-9]{1}|2{1}[0-3]{1}):([0-5]{1}[0-9]{1})$/";
    $valor = '10:21';
    $casamentos = [];

    if(preg_match($regex, $valor, $casamentos)){
        echo 'Casou: ';
        var_dump($casamentos);
    }
    else{
        echo 'Nao achou';
    }

?>