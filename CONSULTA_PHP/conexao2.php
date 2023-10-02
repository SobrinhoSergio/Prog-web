<?php
$host = 'localhost';
$dbname = 'cadastro_pessoas_db';
$username = 'root';
$password = '';

$pdo = null;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname; charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conectado!!!', PHP_EOL;


    $ps = $pdo->prepare(" 
        SELECT   
            preco_compra * estoque AS inventario,
            AVG(preco_compra) AS media_preco
        FROM produto
    ");

    $ps->setFetchMode(PDO::FETCH_ASSOC);
    $ps->execute();
    $produto = $ps->fetch();

    echo $produto['descricao'], PHP_EOL;
    echo $produto['inventario'], PHP_EOL;
    echo $produto['media_preco'], PHP_EOL;



} catch (Exception $e) {
    die( 'Erro ao conectar: ' . $e->getMessage());
}

