<?php

$metodo = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];

echo "Vc solicitou um $metodo para $url";

if($metodo === 'POST'){
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];

    echo "Vc está tentando cadastrar $nome com idade $idade";
    
}