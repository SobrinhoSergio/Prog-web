<?php

require_once 'RepositorioCidadeEmBdr.php';
require_once 'conectar.php';

$pdo = null;

try{

    $pdo = conectar();

    $repo = new RepositorioCidadeEmBDR( $pdo );
    
    if ( isset( $_GET[ 'id' ] ) ) {
        $removeu = $repo->removerPeloId( $_GET[ 'id' ] );
        if(!$removeu ) {
            http_response_code( 404 );
            die("Cidade não encontrado para remoção!");
        }
        else{
            http_response_code( 204 );
            //Direciona
            header('Location: index.php');
            die();
        }
    } 
    
    else {
        http_response_code( 400 );
        die("Informe o ID da cidade!");
    }

}catch(PDOException $e){
    http_response_code(500);
    die("Erro processamento Operação!". $e->getMessage());
}