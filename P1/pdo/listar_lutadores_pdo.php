<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $queryListLutadores = "SELECT * FROM lutador";
    $stmtListLutadores = $conn->query($queryListLutadores);

    $lutadores = $stmtListLutadores->fetchAll(PDO::FETCH_ASSOC);

    if (count($lutadores) > 0) {
        echo "Listagem de lutadores:\n";
        foreach ($lutadores as $lutador) {
            echo "ID: {$lutador['id']} - Nome: {$lutador['nome']} - Peso: {$lutador['peso_em_quilos']} kg - Altura: {$lutador['altura_em_metros']} m\n";
        }
    } else {
        echo "Nenhum lutador encontrado.\n";
    }
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

$conn = null;
?>
