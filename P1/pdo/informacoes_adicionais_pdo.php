<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $queryAdditionalInfo = "SELECT COUNT(*) as total_lutadores, AVG(altura_em_metros) as media_alturas, MAX(altura_em_metros) as maior_altura, MAX(peso_em_quilos) as maior_peso FROM lutador";
    $stmtAdditionalInfo = $conn->query($queryAdditionalInfo);

    $info = $stmtAdditionalInfo->fetch(PDO::FETCH_ASSOC);

    echo "Número total de lutadores: {$info['total_lutadores']}\n";
    echo "Média de alturas: {$info['media_alturas']} m\n";
    echo "Maior altura: {$info['maior_altura']} m\n";
    echo "Maior peso: {$info['maior_peso']} kg\n";
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

$conn = null;
?>
