<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Materia Prima</title>
</head>
<body>
    <form action="cadastrar-MT.php" method="POST">
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" id="descricao">
        <label for="quantidade">Quantidade: </label>
        <input type="number" name="quantidade" id="quantidade">
        <label for="custo">Custo: </label>
        <input type="number" name="custo" id="custo">
        <label for="categoria">Categoria: </label>
        <select name="categoria" id="categoria">
            <?php
                require_once 'repositorio-categoria.php';
                require_once 'conexao.php';
                $p = conectar();
                $pdo = new RepositorioCategoria($p);
                $ps = $pdo->listar();
                foreach($ps as $c){
                    echo <<<HTML
                        <option name="$c[id]" id="$c[id]">$c[nome]</option>
                HTML;
                }
            ?>
        </select>
        <button type="submit" id="enviar">Enviar</button>
    </form>
</body>
</html>