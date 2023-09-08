<?php
    //input pattern="/expressão regular/"
    $regex = "/^[A-Z][A-Za-z\-. ]{1,59}$/";
    $valor = "Ana Paula S. Barroso";
    $casamentos = [];

    if(preg_match($regex, $valor, $casamentos)){
        echo 'Casou: ';
        var_dump($casamentos);
    }
    else{
        echo 'Nao achou';
    }

?>