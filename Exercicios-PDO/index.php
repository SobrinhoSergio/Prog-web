<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lutadores</title>
</head>
<body>
    <h1>Lista de Lutadores</h1>
    <table border='1'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Peso (kg)</th>
                <th>Altura (m)</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'listar.php'; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan='4'>Total de Lutadores: <?php echo $totalLutadores; ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
