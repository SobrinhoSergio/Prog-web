<?php

$url = htmlspecialchars($_SERVER['REQUEST_URI']);
$metodo = htmlspecialchars($_SERVER['REQUEST_METHOD']); 

if($metodo === 'GET' && $url === '/contas-pagar'){
    listarCarros();
}

else if($metodo === 'POST' && $url === '/contas-pagar'){
    cadastrarCarros();
}

else if($metodo === 'DELETE' && mb_strpos($url, '/contas-pagar') !== false){
    removerCarroPeloId();
}

if ( $metodo === 'GET' && $url === '/contas-pagar') {
    
    $cabecalhos = getallheaders();
    
    $formato = isset( $cabecalhos[ 'Accept' ] ) ? $cabecalhos[ 'Accept' ] : 'text/html';
    
    if ( $formato == 'application/json' ) {
        retornarEmJson();
    } else {
        retornarEmHtml();
    }
}

else{
    http_response_code(404);
    die("Não achei");;
}