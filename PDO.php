<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para cadastrar um lutador
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST["nome"];
        $peso = $_POST["peso"];
        $altura = $_POST["altura"];

        $query = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) VALUES (:nome, :peso, :altura)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
    }

    // Função para listar lutadores
    $queryListLutadores = "SELECT * FROM lutador";
    $stmtListLutadores = $conn->query($queryListLutadores);

    $totalLutadores = 0;

    echo "<h1>Cadastrar e Listar Lutadores</h1>";

    // Formulário de cadastro
    echo "<h2>Cadastrar Novo Lutador:</h2>";
    echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
    echo "<label for='nome'>Nome:</label>";
    echo "<input type='text' id='nome' name='nome' required><br>";
    echo "<label for='peso'>Peso (kg):</label>";
    echo "<input type='number' id='peso' name='peso' step='0.01' required><br>";
    echo "<label for='altura'>Altura (m):</label>";
    echo "<input type='number' id='altura' name='altura' step='0.01' required><br>";
    echo "<button type='submit'>Cadastrar</button>";
    echo "</form>";

    // Lista de lutadores
    echo "<h2>Lista de Lutadores:</h2>";
    if ($stmtListLutadores->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Peso (kg)</th><th>Altura (m)</th></tr>";

        while ($row = $stmtListLutadores->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['peso_em_quilos']}</td>
                    <td>{$row['altura_em_metros']}</td>
                </tr>";
            $totalLutadores++;
        }

        echo "</table>";
        echo "<p>Total de Lutadores: $totalLutadores</p>";
    } else {
        echo "<p>Nenhum lutador encontrado.</p>";
    }

} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

$conn = null;
?>
