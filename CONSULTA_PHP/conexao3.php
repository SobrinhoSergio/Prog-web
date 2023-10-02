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
                            SUM(preco_compra * estoque) AS inventario_total,
                            AVG(preco_compra) AS media_preco
                        FROM produto
                        ");
    
    $ps->execute();
    $resultado = $ps->fetch();

    echo $resultado['inventario_total'], PHP_EOL;
    echo $resultado['media_preco'], PHP_EOL;

} catch (Exception $e) {
    die('Erro ao conectar: ' . $e->getMessage());
}
?>
