<?php

require_once 'conexao.php';
require_once 'RepositorioContaEmBDR.php';
require_once 'Conta.php';

$nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';

$fabricante = isset($_POST['fabricante']) ? htmlspecialchars($_POST['fabricante']) : '';

$valor = isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : 0;

if(mb_strlen($nome) > 80 || empty($nome)){
    http_reponse_code(400);
    die("Nome tem que ter no máximo 80 caracteres e não ser vazio.");
}

if(mb_strlen($nome) > 30 || empty($fabricante)){
    http_reponse_code(400);
    die("Fabricante tem que ter no máximo 30 caracteres não pode ser vaio.");
}

if(!is_numeric($valor)){
    http_reponse_code(400);
    die("O valor precisa ser um númerico");
}

$pdo = null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare("INSERT INTO conta (nome, fabricante, valor) VALUES (:nome, :fabricante, :valor)");

    $ps->execute([':nome' => $nome,
                  ':fabricante' => $fabricante,
                  ':valor' => $valor]);
    
    http_reponse_code(201);

}catch(PDOException $e){
    http_reponse_code(500);
    echo "Erro ao cadastrar: ". $e->getMessage();
}


## 

try{

    $pdo = conectar();

    $repositorio = new RepositorioContaEmBDR($pdo);

    $conta = new Conta(0, $nome, $fabricante, $valor);

    $repositorio->cadastrarConta($conta);

    http_reponse_code(201);

    echo "Conta cadastrada com sucesso!";

}catch(PDOException $e){
    http_reponse_code(500);
    echo "Erro ao cadastrar: ". $e->getMessage();
}
