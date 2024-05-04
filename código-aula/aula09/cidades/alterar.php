<?php

require_once 'RepositorioCidadeEmBdr.php';
require_once 'conectar.php';
require_once 'Cidade.php';


$pdo = null;

try{

    $pdo = conectar();

    $repo = new RepositorioCidadeEmBDR( $pdo );
    
    if ( isset( $_POST[ 'id' ], $_POST[ 'nome' ] ) ) {
        $cidade = new Cidade($_POST[ 'id' ], $_POST[ 'nome' ] );

        $alterou = $repo->atualizar($cidade);

        if(!$alterou){
            http_response_code(404);
            die("Cidade não encontrada para atualização!");
        }

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