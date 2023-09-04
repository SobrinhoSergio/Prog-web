<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM lutador WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $lutador = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$lutador) {
        echo "Lutador não encontrado.";
        exit;
    }
} else {
    echo "ID do lutador não fornecido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    try {
        $stmt = $pdo->prepare("UPDATE lutador SET nome = :nome, idade = :idade, peso = :peso, altura = :altura WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);

        $stmt->execute();

        echo "Lutador atualizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lutador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>
    
    <div class="container mt-5">
        <h2>Editar Lutador</h2>
        <form method="POST">
        <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $lutador['nome'] ?>" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" class="form-control" id="idade" name="idade" value="<?= $lutador['idade'] ?>" required>
            </div>
            <div class="form-group">
                <label for="peso">Peso:</label>
                <input type="number" class="form-control" id="peso" step="0.01" name="peso" value="<?= $lutador['peso'] ?>" required>
            </div>
            <div class="form-group">
                <label for="altura">Altura:</label>
                <input type="number" class="form-control" id="altura" step="0.01" name="altura" value="<?= $lutador['altura'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</body>
</html>
