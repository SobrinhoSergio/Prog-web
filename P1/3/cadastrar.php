<?php

try{    
    $pdo = new PDO('mysql:host=localhost;dbname=aula07;charset=utf8', 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

}catch(PDOException $e){
    die("Erro ao conectar: ".$e->getMessage());
}

$repo = new LutadorRepositoryBDR($pdo);

// Lendo os detalhes do lutador do usuário
echo "Digite o nome do lutador: ";
$nome = readline();

echo "Digite o peso do lutador (em quilos): ";
$peso = readline();

echo "Digite a altura do lutador (em metros): ";
$altura = readline();

// Validando os valores
if (!is_numeric($peso) || $peso <= 0) {
    die("Erro: O peso deve ser um número positivo.");
}

if (!is_numeric($altura) || $altura <= 0) {
    die("Erro: A altura deve ser um número positivo.");
}

// Criando um objeto Lutador
$lutador = new Lutador();
$lutador->nome = $nome;
$lutador->pesoEmQuilos = (float) $peso;
$lutador->alturaEmMetros = (float) $altura;

// Chamando a função adicionarLutador do repositório
try {
    $repo->adicionarLutador($lutador);
    echo "Lutador adicionado com sucesso!";
} catch (RepositorioException $e) {
    echo "Erro ao adicionar lutador: " . $e->getMessage();
}
?>
