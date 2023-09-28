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


    $ps = $pdo->query(' SELECT descricao, preco_compra * estoque AS inventario FROM produto');

    foreach ($ps as $produto){
        echo $produto['descricao'], PHP_EOL;
        echo $produto['inventario'], PHP_EOL;

    }

} catch (Exception $e) {
    die( 'Erro ao conectar: ' . $e->getMessage());
}

