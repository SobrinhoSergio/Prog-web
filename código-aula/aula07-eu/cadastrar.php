<?php

try{
    $pdo = new PDO('mysql:hots=localhost;dbname=aula07;charset=utf8', 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(PDOException $e){
    die("Erro ao conectar: " .$e->getMessage());
}

$repo = new LutadorRepositorioBdr($pdo);

$nome = readline("");
$peso = readline("");
$altura = readline("");

$lutador = new Lutador();
$lutador->nome = $nome;
$lutador->peso = (float) $peso;
$lutador->altura = (float) $altura;

try{
    $repo = adicionarLutador($lutador);
    echo "Lutador adicionado com Sucesso!";
}catch(PDOException $e){
    die("Erro ao cadastrar: " .$e->getMessage());
}
