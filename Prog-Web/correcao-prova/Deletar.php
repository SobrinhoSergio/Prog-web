<?php

require_once 'conexao.php';

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 0;

if (!is_numeric($id)) {
    http_response_code(400);
    die("Um ID deve ser um número");
}

$pdo = null;

try {
    $pdo = conectar();

    $ps = $pdo->prepare('DELETE FROM autor WHERE id = :id');

    $ps->execute([':id' => $id]);

    if ($ps->rowCount() > 0) {
        http_response_code(204); 
    } else {
        http_response_code(404);
        die("Autor não encontrado.");
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}


####===============================

try {
    $pdo = conectar();
    $repositorio = new RepositorioAutorEmBDR($pdo);

    if ($repositorio->removerAutorPorId($id)) {
        http_response_code(204); 
    } else {
        http_response_code(404); 
        die("Autor não encontrado.");
    }

} catch (PDOException $e) {
    http_response_code(500); 
    echo "Error: " . $e->getMessage();
}



