<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Lutador</title>
</head>
<body>
    <h1>Cadastrar Lutador</h1>
    <form action="processar-cadastro.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="peso">Peso (kg):</label>
        <input type="number" id="peso" name="peso" step="0.01" required><br>

        <label for="altura">Altura (m):</label>
        <input type="number" id="altura" name="altura" step="0.01" required><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
