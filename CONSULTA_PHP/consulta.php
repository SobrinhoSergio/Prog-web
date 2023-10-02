<?php

require_once 'conexaoBD.php';

$pdo = null;

try {
    $pdo = conectar();
     
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
