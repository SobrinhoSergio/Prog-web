<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Lutadores</title>
</head>
<body>
    <h1>Lista de Lutadores</h1>
    <?php
    require_once 'conexao.php';

    $query = "SELECT * FROM lutador";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr> 
                <th>ID</th>
                <th>Nome</th><th>Peso (kg)</th>
                <th>Altura (m)</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['peso_em_quilos']}</td>
                    <td>{$row['altura_em_metros']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum lutador encontrado.";
    }

    $conn->close();
    ?>
</body>
</html>
