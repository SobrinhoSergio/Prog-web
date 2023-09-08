<?php
function meuHash($conteudo){
    $conteudoComSal = '295646dfk' . $conteudo . '#$%%&&*(';
    return hash('sha256' , $conteudoComSal);
 }
?>