<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form method="POST" action="cadastrar.php" >
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" />
        <label for="validade">Validade:</label>
        <input type="text" id="validade" name="validade" />
        <label for="estoque">Estoque:</label>
        <input type="text" id="estoque" name="estoque" />
        <button >Salvar</button>
    </form>
</body>
</html>