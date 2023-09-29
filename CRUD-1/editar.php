<?php
require_once 'conexao.php';

echo 'EDITAR DESCRIÇÃO', PHP_EOL;

$id = readline('ID da tarefa que deseja editar: ');
$newDescription = readline('Nova descrição: ');

$pdo = null;

try {
    $pdo = conectar();

    $ps = $pdo->prepare('UPDATE tarefa SET descricao = :descricao WHERE id = :id');
    
    $ps->execute(['id' => $id, 'descricao' => $newDescription]);

    echo 'Descrição atualizada com sucesso.';

} catch (PDOException $e) {
    die('Erro: ' . $e->getMessage());
}
?>
