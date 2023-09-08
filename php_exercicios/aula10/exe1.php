<?php
    $regex = "/^[0-9]{2}\.?[0-9]{3}-?[0-9]{3}$/";
    $valor = '28.613001';
    $casamentos = [];

    if(preg_match($regex, $valor, $casamentos)){
        echo 'Casou: ';
        var_dump($casamentos);
    }
    else{
        echo 'Nao achou';
    }

?>