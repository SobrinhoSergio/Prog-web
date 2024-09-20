<?php

$nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']): '';

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 0;

$fabricante = isset($_POST['fabricante']) ? htmlspecialchars($_POST['fabricante']) : '';

if(!is_numeric($id)){
    http_response_code(400);
    die("O id precisa ser numérico");
}

$pdo = null;

try{

    $pdo = conectar();

    $ps = $pdo->prepare('UPDATE conta SET nome = :nome, fabricante = :fabricante, valor = :valor WHERE id = :id');

    $ps->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':fabricante' => $fabricante,
        ':valor' => $valor
    ]);

    if($ps->rowCount()>0){
        http_reponse_code(201);
        die("Conta cadastrada com Sucesso!");
    }
    else{
        http_reponse_code(404);
        die("Conta não encontrada!");
    }

}catch(PDOException $e){
    http_reponse_code(500);
    echo "Erro ao editar: " . $e->getMessage();
}