<?php

// Sabemos que aqui precisa de uma série de importações 
// E aqui usaremos a transaction

try{
    $pdo = new PDO('mysql:host=localhost;dbname=aula07;charset=utf8', 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(PDOException $e){
    die("Erro ao conectar: ".$e->getMessage());
}

$rep = new RepositorioLutadorBdr($pdo);

echo "Informe os dois IDs a serem removido: ", PHP_EOL;

$id1 = readline("");
$id2 = readline("");

try{
    $pdo->beginTransaction();

    $ok = $rep->remover($id1);

    if(!ok){
        $pdo->roolback();
        return;
    }

    $ok = $rep->remover($id2);

    if(!ok){
        $pdo->roolback();
        return;
    }
    $pdo->commit();
}catch(PDOException $e){
    $pdo->roolback();
    die($e->getMessage());
}
