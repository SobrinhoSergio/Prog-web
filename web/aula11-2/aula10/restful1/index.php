<?php
$metodo = $_SERVER[ 'REQUEST_METHOD' ];
$url = $_SERVER[ 'REQUEST_URI' ];
echo "Você soliciou um $metodo para $url";
if ( $metodo === 'POST' ) {
    $nome = $_POST[ 'nome' ];
    $idade = $_POST[ 'idade' ];
    echo "Você está tentando cadastrar $nome com idade $idade";
}
?>