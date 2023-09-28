<?php

require_once('./conexao.php');

try {
    // Consulta para listar todos os lutadores
    $ps = $pdo->prepare("
        SELECT *,
            (SELECT COUNT(*) FROM lutador) AS total_lutadores,
            (SELECT AVG(altura) FROM lutador) AS media_alturas,
            (SELECT MAX(altura) FROM lutador) AS maior_altura,
            (SELECT MAX(peso) FROM lutador) AS maior_peso
        FROM lutador
    ");

    $ps->setFetchMode(PDO::FETCH_ASSOC);
    $ps->execute();
    $dados = $ps->fetch();

    echo '<table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Peso</th>
                <th>Altura</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($ps as $p) {
        echo '<tr>';
        echo '<td>' . $p['id'] . '</td>';
        echo '<td>' . $p['nome'] . '</td>';
        echo '<td>' . $p['peso'] . '</td>';
        echo '<td>' . $p['altura'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>
        <tfoot>
            <tr>
                <td colspan="4">Total de Lutadores: ' . $dados['total_lutadores'] . '</td>
            </tr>
            <tr>
                <td colspan="4">Média das Alturas: ' . $dados['media_alturas'] . '</td>
            </tr>
            <tr>
                <td colspan="4">Maior Altura: ' . $dados['maior_altura'] . '</td>
            </tr>
            <tr>
                <td colspan="4">Maior Peso: ' . $dados['maior_peso'] . '</td>
            </tr>
        </tfoot>
    </table>';
    
} catch (PDOException $e) {
    die("Erro ao consultar o banco de dados: " . $e->getMessage());
}

?>
