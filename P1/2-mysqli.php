<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta para listar todos os lutadores
$queryListLutadores = "SELECT * FROM lutador";
$resultListLutadores = $conn->query($queryListLutadores);

if ($resultListLutadores->num_rows > 0) {
    // a) Listagem de todos os lutadores
    echo "Listagem de lutadores:\n";
    while ($row = $resultListLutadores->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . " - Peso: " . $row["peso_em_quilos"] . " kg - Altura: " . $row["altura_em_metros"] . " m\n";
    }
    echo "\n";

    // b) Consulta para obter informações adicionais
    $queryAdditionalInfo = "SELECT COUNT(*) as total_lutadores, AVG(altura_em_metros) as media_alturas, MAX(altura_em_metros) as maior_altura, MAX(peso_em_quilos) as maior_peso FROM lutador";
    $resultAdditionalInfo = $conn->query($queryAdditionalInfo);

    if ($resultAdditionalInfo->num_rows > 0) {
        $row = $resultAdditionalInfo->fetch_assoc();
        echo "Número total de lutadores: " . $row["total_lutadores"] . "\n";
        echo "Média de alturas: " . $row["media_alturas"] . " m\n";
        echo "Maior altura: " . $row["maior_altura"] . " m\n";
        echo "Maior peso: " . $row["maior_peso"] . " kg\n";
    }
} else {
    echo "Nenhum lutador encontrado.\n";
}

// Fechar a conexão
$conn->close();
?>
