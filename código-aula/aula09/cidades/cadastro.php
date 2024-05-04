<?php

require_once 'RepositorioCidadeEmBdr.php';
require_once 'conectar.php';
require_once 'Cidade.php';


$pdo = null;

try{

    $pdo = conectar();

    $repo = new RepositorioCidadeEmBDR( $pdo );
    
    if ( isset( $_POST[ 'nome' ] ) ) {
        $cidade = new Cidade(0, $_POST[ 'nome' ] );

        $repo->adicionar($cidade);

        //http_reponse_code(201);
        //http_reponse_code(307);
        http_response_code(200);


        header('Location: index.php');
        die($cidade->id);
       
    } 
    else {
        http_response_code( 400 );
        die("Campo não enviado: nome");
    }

}catch(PDOException $e){
    http_response_code(500);
    die("Erro processamento Operação!". $e->getMessage());
}