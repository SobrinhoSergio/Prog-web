<?php

    $n = rand(1,20);

    echo "Os $n primeiros números da sequência de Fibonacci são: \n";

    for($i=0; $i<=$n;$i++){
        echo $i > 2 ? ($i-1)+($i-2) : $i,"\n"; 
    }

?> 