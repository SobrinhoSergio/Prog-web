<?php
    function cumprimentar($nome = 'Anonimo', $cumprimento = 'Ola'){
        echo $cumprimento, ' ', $nome, PHP_EOL;
    }

    cumprimentar();
    cumprimentar('Ana', 'Oi');

    function f(){
        static $x = 0;
        echo ++$x, PHP_EOL;
    }

    f();
    f();
    f();
?>