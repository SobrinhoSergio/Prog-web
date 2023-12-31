<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
</head>
<body>
    <h1>Games</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Ano</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $games = $repositorio->obterTodos();
                foreach($games as $g){
                    echo <<<HTML
                        <tr>
                            <td>{g->$id}</td>
                            <td>{g->$nome}</td>
                            <td>{g->$genero}</td>
                            <td>{g->$ano}</td>
                        </tr>
                    HTML;
                }
            ?>
        </tbody>
    </table>
</body>
</html>