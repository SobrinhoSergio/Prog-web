<?php
    function dividir($x,$y){
        if($y == 0){
            throw new Exception('Divisao por zero nao e permitida');
        }
        return $x/$y;
    }

    function x(){
        $numero = readline('numero:');
        try{
            return dividir(100,$numero);
        }catch(Exception $e){
            echo $e->getMessage();
        }finally{
            echo 'terminado.';
            //return 20;
        }
    }

    x();
?>