<?php
    function fatorial($numero){
        return  $numero > 1 ? $numero * fatorial($numero - 1) : 1;
    }

    for($i = 1; $i <=30; $i++){
        echo "$i! = ", fatorial($i), "\n"; 
    }
?>