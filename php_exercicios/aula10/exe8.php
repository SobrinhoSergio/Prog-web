<?php
    $regex = "/^[A-Za-z0-9.-_]+@[a-z-]+\.[a-z]+$/";
    $valor = 'email.email@cefet-rj.com';
    $casamentos = [];

    if(preg_match($regex, $valor, $casamentos)){
        echo 'Casou: ';
        var_dump($casamentos);
    }
    else{
        echo 'Nao achou';
    }

?>