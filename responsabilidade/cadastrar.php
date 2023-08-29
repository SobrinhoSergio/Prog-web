<?php
require_once 'db-config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];

    $query = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) VALUES (:nome, :peso, :altura)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':altura', $altura);
    $stmt->execute();

    header("Location: listar.php");
}
?>
