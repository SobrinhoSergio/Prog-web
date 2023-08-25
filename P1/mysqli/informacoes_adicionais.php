<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$queryAdditionalInfo = "SELECT COUNT(*) as total_lutadores, AVG(altura_em_metros) as media_alturas, MAX(altura_em_metros) as maior_altura, MAX(peso_em_quilos) as maior_peso FROM lutador";
$resultAdditionalInfo = $conn->query($queryAdditionalInfo);

if ($resultAdditionalInfo->num_rows > 0) {
    $row = $resultAdditionalInfo->fetch_assoc();
    echo "Número total de lutadores: " . $row["total_lutadores"] . "\n";
    echo "Média de alturas: " . $row["media_alturas"] . " m\n";
    echo "Maior altura: " . $row["maior_altura"] . " m\n";
    echo "Maior peso: " . $row["maior_peso"] . " kg\n";
}

$conn->close();
?>
