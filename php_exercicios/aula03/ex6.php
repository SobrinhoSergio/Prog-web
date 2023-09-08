<?php
$dados = [ 'carro', 'carro', 'caminhão', 'caminhão', 'bicicleta', 
'caminhada', 'carro', 'van', 'bicicleta', 'caminhada', 'carro', 
'van', 'carro', 'caminhão' ];

function qtdPalavras(array $dados){
    $palavras = [];
    foreach($dados as $dado){
        if(isset($palavras[$dado])){
            $palavras[$dado]++;
        }
        else{
            $palavras[$dado] = 1;
        }
    }
    return $palavras;
}

print_r(qtdPalavras($dados));

?>