<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta para listar todos os lutadores
    $queryListLutadores = "SELECT * FROM lutador";
    $stmtListLutadores = $conn->query($queryListLutadores);

    if ($stmtListLutadores->rowCount() > 0) {
        // a) Listagem de todos os lutadores
        echo "Listagem de lutadores:\n";
        while ($row = $stmtListLutadores->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . " - Peso: " . $row["peso_em_quilos"] . " kg - Altura: " . $row["altura_em_metros"] . " m\n";
        }
        echo "\n";

        // b) Consulta para obter informações adicionais
        $queryAdditionalInfo = "SELECT COUNT(*) as total_lutadores, AVG(altura_em_metros) as media_alturas, MAX(altura_em_metros) as maior_altura, MAX(peso_em_quilos) as maior_peso FROM lutador";
        $stmtAdditionalInfo = $conn->query($queryAdditionalInfo);

        if ($stmtAdditionalInfo->rowCount() > 0) {
            $row = $stmtAdditionalInfo->fetch(PDO::FETCH_ASSOC);
            echo "Número total de lutadores: " . $row["total_lutadores"] . "\n";
            echo "Média de alturas: " . $row["media_alturas"] . " m\n";
            echo "Maior altura: " . $row["maior_altura"] . " m\n";
            echo "Maior peso: " . $row["maior_peso"] . " kg\n";
        }
    } else {
        echo "Nenhum lutador encontrado.\n";
    }
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

$conn = null;
?>
