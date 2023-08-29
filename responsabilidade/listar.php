<?php
require_once 'db-config.php';

$query = "SELECT * FROM lutador";
$stmt = $conn->query($query);

$totalLutadores = 0;

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['peso_em_quilos']}</td>
                <td>{$row['altura_em_metros']}</td>
            </tr>";
        $totalLutadores++;
    }
} else {
    echo "<tr><td colspan='4'>Nenhum lutador encontrado.</td></tr>";
}

$conn = null;
?>
