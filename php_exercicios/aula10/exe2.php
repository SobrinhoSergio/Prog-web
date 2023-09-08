<?php
    //exercicio 2
    //$regex = "/^[0-9]{4,5}-?[0-9]{4}$/";
    $regex = "/^(\([0-9]{2}\) ?|[0-9]{2} ?)?[0-9]{4,5}-?[0-9]{4}$/";
    $valor = '22 22333-4455';
    $casamentos = [];

    if(preg_match($regex, $valor, $casamentos)){
        echo 'Casou: ';
        var_dump($casamentos);
    }
    else{
        echo 'Nao achou';
    }

?>