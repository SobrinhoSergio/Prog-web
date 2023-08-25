<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Função para cadastrar um lutador
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];

    $query = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) VALUES ('$nome', '$peso', '$altura')";

    if ($conn->query($query) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        echo "Erro ao cadastrar o lutador: " . $conn->error;
    }
}

// Função para listar lutadores
$queryListLutadores = "SELECT * FROM lutador";
$resultListLutadores = $conn->query($queryListLutadores);

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
if ($resultListLutadores->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Peso (kg)</th><th>Altura (m)</th></tr>";

    while ($row = $resultListLutadores->fetch_assoc()) {
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

$conn->close();
?>
