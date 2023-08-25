<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];

    $query = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) VALUES ('$nome', '$peso', '$altura')";

    if ($conn->query($query) === TRUE) {
        header("Location: listar-lutadores.php");
    } else {
        echo "Erro ao cadastrar o lutador: " . $conn->error;
    }
}

$conn->close();
?>
