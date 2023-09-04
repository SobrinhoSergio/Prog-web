<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Lutadores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

</head>
<body>

    <div class="container mt-5">
        <h2>Pesquisar Lutadores</h2>
        
        <form method="POST" class="mb-3">
                <div class="form-row align-items-end">
                    <div class="col-md-3">
                        <label for="campo">Campo:</label>
                        <select class="form-control" id="campo" name="campo">
                            <option value="nome">Nome</option>
                            <option value="idade">Idade</option>
                            <option value="peso">Peso</option>
                            <option value="altura">Altura</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="valor">Valor:</label>
                        <input type="text" class="form-control" id="valor" name="valor">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        <button type="reset" class="btn btn-warning"><i class="bi bi-x text-white"></i></button>
                    </div>
                </div>
        </form>

        <?php
            include 'conexao.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $campo = $_POST["campo"];
                $valor = $_POST["valor"];

                try {
                    // Prepara a consulta SQL
                    $stmt = $pdo->prepare("SELECT * FROM lutador WHERE $campo LIKE :valor");
                    
                    // Associa os parâmetros
                    $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
                    
                    // Executa a consulta
                    $stmt->execute();
                    
                    // Verifica se existem resultados
                    if ($stmt->rowCount() > 0) {
                        echo "<h3>Resultados:</h3>";
                        echo "<table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Idade</th>
                                        <th>Peso</th>
                                        <th>Altura</th>
                                    </tr>
                                </thead>";
                
                        // Exibe os resultados
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                                <tbody>
                                    <tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["nome"] . "</td>
                                        <td>" . $row["idade"] . "</td>
                                        <td>" . $row["peso"] . "</td>
                                        <td>" . $row["altura"] . "</td>
                                    </tr>
                                </tbody>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>Nenhum resultado encontrado.</p>";
                    }
                } catch (PDOException $e) {
                    echo "Erro na consulta: " . $e->getMessage();
                }
            }
        ?>
    </div>

</body>
</html>
