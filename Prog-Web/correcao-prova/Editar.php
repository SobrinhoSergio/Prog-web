<?php

require_once 'conexao.php';

$id = isset($_GET['id']) ?  htmlspecialchars($_GET['id']) : 0;

$nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';

$nascimento = isset($_POST['nascimento']) ? htmlspecialchars($_POST['nascimento']) : '';

if (!is_numeric($id)) {
    http_response_code(400);
    die("Um ID deve ser um número");
}

$pdo = null;

try {
    $pdo = conectar();

    $ps = $pdo->prepare('UPDATE autor SET nome = :nome, nascimento = :nascimento WHERE id = :id');

    $ps->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':nascimento' => $nascimento
    ]);

    if ($ps->rowCount() > 0) {
        http_response_code(200); 
        echo "Autor atualizado com sucesso.";
    } else {
        http_response_code(404);
        die("Autor não encontrado.");
    }

} catch (PDOException $e) {
    // Erro no servidor ou no banco de dados
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}

##=========================


try {
    $pdo = conectar();
    $repositorio = new RepositorioAutorEmBDR($pdo);

    $autor = new Autor($id, $nome, $nascimento);

    if ($repositorio->atualizarAutor($autor)) {
        http_response_code(200); 
        echo "Autor atualizado com sucesso.";
    } else {
        http_response_code(404); 
        die("Autor não encontrado.");
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}

