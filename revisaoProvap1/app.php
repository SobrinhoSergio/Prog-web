<?php

function conectar(){
    return new PDO(
        "mysql:host=localhost;dbname=provaP1;charset=utf8",
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
}

try{

    $pdo = conectar();

    $r = new RepositorioClienteEmBdr($pdo);

    $nome = readline("Digite o nome: ");
    $telefone = readline("Digite o telefone: ");

    $cliente = new Cliente(null, $nome, $telefone);

    $mensagens = $cliente->validar();

    if(!empty($mensagens)){
        foreach($mensagens as $m){
            echo $m;
        }
        exit();
    }

    $r->adicionar($cliente);

}catch(RepositorioException $e){
    die($e->getMessage); 
}
