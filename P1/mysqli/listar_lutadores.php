<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$queryListLutadores = "SELECT * FROM lutador";
$resultListLutadores = $conn->query($queryListLutadores);

if ($resultListLutadores->num_rows > 0) {
    echo "Listagem de lutadores:\n";
    while ($row = $resultListLutadores->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . " - Peso: " . $row["peso_em_quilos"] . " kg - Altura: " . $row["altura_em_metros"] . " m\n";
    }
} else {
    echo "Nenhum lutador encontrado.\n";
}

$conn->close();
?>
