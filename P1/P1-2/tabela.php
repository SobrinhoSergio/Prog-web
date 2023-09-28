<?php

require_once 'conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <title>Lista de Lutadores</title>
</head>
<body>
    <div class="container">
        <h1>Lista de Lutadores</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Peso</th>
                    <th>Altura</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try {
                        // Consulta para listar todos os lutadores
                        $ps = $pdo->prepare("SELECT * FROM lutador");
                        $ps->setFetchMode(PDO::FETCH_ASSOC); 
                        $ps->execute();

                        foreach ($ps as $p) {
                            echo '<tr>';
                            echo '<td>' . $p['id'] . '</td>';
                            echo '<td>' . $p['nome'] . '</td>';
                            echo '<td>' . $p['peso'] . '</td>';
                            echo '<td>' . $p['altura'] . '</td>';
                            echo '</tr>';
                        }
                        
                    }catch(PDOException $e){
                        die("Error ao exibir dados: " . $e->getMessage());
                    }
                ?>
            </tbody>
            <tfoot>
                <?php
                    try {
                        // Consulta para listar todos os lutadores
                        $ps = $pdo->prepare("
                            SELECT 
                                COUNT(id) AS total_lutadores,
                                AVG(altura) AS media_alturas,
                                MAX(altura) AS maior_altura,
                                MAX(peso) AS maior_peso
                            FROM lutador
                        ");

                        $ps->setFetchMode(PDO::FETCH_ASSOC);
                        $ps->execute();
                        $dados = $ps->fetch();
                    
                        echo '<tr>';
                        echo '<td>' . 'Total de Lutadores: ', $dados['total_lutadores'] . '</td>';
                        echo '<td>' . 'Media das alturas: ', $dados['media_alturas'] . '</td>';
                        echo '<td>' . 'Maior altura: ', $dados['maior_altura'] . '</td>';
                        echo '<td>' . 'Maior peso: ', $dados['maior_peso'] . '</td>';
                        echo '</tr>';
                        
                        
                    }catch(PDOException $e){
                        die("Error ao exibir dados: " . $e->getMessage());
                    }
                ?>
            </tfoot>
        </table>
    </div>
</body>
</html>
