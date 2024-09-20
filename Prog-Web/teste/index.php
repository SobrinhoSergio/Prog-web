<?php

$url = htmlspecialchars($_SERVER['REQUEST_URI']);
$metodo = htmlspecialchars($_SERVER['REQUEST_METHOD']);

if($metodo === 'GET' && $url === '/contas-a-pagar'){
    listagemConta();
}

else if($metodo === 'POST' && $url === '/conta-a-pagar'){
    cadastrarConta();
}

else if($metodo === 'DELETE' && mb_strpos($url, '/contas-a-pagar') !== false){
    deletarConta();
}

else {
    http_response_code(404);
    die('Não achei.');
}