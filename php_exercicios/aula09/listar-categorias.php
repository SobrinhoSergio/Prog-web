<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Categorias</title>
</head>
<body>
    <a href="cadastro-categoria.php">Voltar</a>

    <table> 
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once 'repositorio-categoria.php';
                require_once 'conexao.php';
                $p = conectar();
                $pdo = new RepositorioCategoria($p);
                $ps = $pdo->listar();
                foreach($ps as $c){
                    echo <<<HTML
                    <tr>
                        <td>$c[id]</td>
                        <td>$c[nome]</td>
                    </tr>
                HTML;
                }
                //<td> <a href="remover.php?id=$c[id]" >Remover</a> </td>
                //<td> <a href="form.php?id=$c[id]" >Alterar</a> </td>
                ?>
        </tbody>
    
    </table>
</body>
</html>