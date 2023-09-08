<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio aula10</title>
</head>
<body>
    <h1>Produto</h1>
    <form action="salvar.php" method="POST">
    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" id="descricao">
    <label for="validade">Validade(dd/mm/aaaa)</label>
    <input type="text" name="validade">
    <label for="estoque">Estoque</label>
    <input type="number" name="estoque">
    <button type="submit" id="enviar">Enviar</button>
    </form>
</body>
</html>