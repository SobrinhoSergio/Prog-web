<?php

require_once 'conexao.php';
  $pdo = null;

  try{
    $pdo = conectar();
  }catch (PDOException $e){
    die('Erro: ' . $e->getMessage());
  }

  $ps = $pdo->query("SELECT *, estoque * preco as 'inventario' FROM produto", PDO::FETCH_ASSOC);
  echo 'PRODUTOS', PHP_EOL;
  foreach($ps as $linha){
    echo $linha['id'], '-',
    $linha['codigo'], '-',
    $linha['descricao'], '-',
    $linha['estoque'], '-',
    $linha['preco'], '-',
    $linha['inventario'], PHP_EOL;
  }

  $ps = $pdo->query("SELECT COUNT(id) AS contagem, SUM(estoque) AS estoque, 
  CAST(AVG(preco) AS DECIMAL(10,2)) AS media_preco FROM produto", PDO::FETCH_ASSOC);
  $linha =  $ps->fetch();
  echo 'Contagem:', $linha['contagem'], ' - ', 'Estoque total: ', $linha['estoque'], ' - ', 'Media Preco: R$', $linha['media_preco'];



?>