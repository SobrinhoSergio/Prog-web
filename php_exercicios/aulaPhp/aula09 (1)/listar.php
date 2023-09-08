<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matérias-Primas</title>
</head>
<body>
    <h1>Matérias-Primas</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Custo (R$)</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require_once 'RepositorioCategoriaEmBDR.php';
            require_once 'RepositorioMateriaPrimaEmBDR.php';
            require_once 'RepositorioException.php';

            $materiasPrimas = [];
            try {
                $pdo = new PDO( 'mysql:dbname=aula09;host=localhost;charset=utf8', 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                $repositorioCat = new RepositorioCategoriaEmBDR( $pdo );
                $repositorioMP = new RepositorioMateriaPrimaEmBDR( $pdo, $repositorioCat );

                $materiasPrimas = $repositorioMP->consultarMateriasPrimas();
            } catch ( PDOException $pe ) {
                echo 'Erro ao conectar com o banco de dados.';
            } catch ( RepositorioException $re ) {
                echo $re->getMessage();
            }

            foreach ( $materiasPrimas as $mp ) {
                echo <<<HTML
                    <tr>
                        <td>{$mp->id}</td>
                        <td>{$mp->descricao}</td>
                        <td>{$mp->quantidade}</td>
                        <td>{$mp->custo}</td>
                        <td>{$mp->categoria->nome}</td>
                    </tr>
                HTML;
            }
        ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</body>
</html>

