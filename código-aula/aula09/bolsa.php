<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Cadastro de Bolsa</h1>

    <form method="POST" action="cadastro-bolsa.php">
        <label for="nome">Nome: </label>
        <input type="text" id="nome" name="nome"/>

        <label for="nascimento">Nascimento: </label>
        <input type="date" id="nascimento" name="nascimento"/>

        <button type="submit" id="enviar">Enviar</button>
    </form>

</body>
</html>

