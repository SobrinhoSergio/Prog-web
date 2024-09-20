<?php

require_once 'conexao.php';
require_once 'RepositorioAutorEmBDR.php';
require_once 'Autor.php';

$nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';

$nascimento = isset($_POST['nascimento']) ? htmlspecialchars($_POST['nascimento']) : '';
 
if (mb_strlen($nome) > 80 || empty($nome)) {
    http_response_code(400);
    die("O nome deve ter 80 caracteres no máximo e não ser vazio.");
}

if(empty($nascimento)){
    http_response_code(400);
    die("Uma data de nascimento deve ser informada.");
}

$nascimentoEmPartes = explode('/', $nascimento);

$dia = (int) $nascimentoEmPartes[0];
$mes = (int) $nascimentoEmPartes[1];
$ano = (int) $nascimentoEmPartes[2];

if(!checkdate($dia, $mes, $ano)){
    http_response_code(400);
    die("Informe uma data válida");
}


$pdo = null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare('INSERT INTO autor (nome, nascimento) VALUES (:nome, :nascimento)');

    $ps->execute([':nome' => $nome,
                  ':nascimento' => $nascimento
    ]);

    http_response_code(201);

}catch(PDOException $e){
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}

#=======================================

$pdo = null;

try {
    $pdo = conectar();
    
    $repositorio = new RepositorioAutorEmBDR($pdo);

    $autor = new Autor(0, $nome, $nascimento);

    $repositorio->adicionarAutor($autor);

    http_response_code(201); 
    echo "Autor cadastrado com sucesso.";

} catch (PDOException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}