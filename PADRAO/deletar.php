<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM lutador WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "Lutador excluído com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "ID do lutador não fornecido.";
    exit;
}
?>
