<?php
// Configurações do banco de dados
require_once 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    try {
        $stmt = $pdo->prepare("INSERT INTO lutador (nome, idade, peso, altura)
                               VALUES (:nome, :idade, :peso, :altura)");
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        
        $stmt->execute();

        echo "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>