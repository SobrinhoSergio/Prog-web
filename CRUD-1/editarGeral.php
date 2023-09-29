<?php
require_once 'conexao.php';

function editarDescricao($pdo) {
    echo 'EDITAR DESCRIÇÃO', PHP_EOL;
    $id = readline('ID da tarefa que deseja editar: ');
    $newDescription = readline('Nova descrição: ');

    $stmt = $pdo->prepare('UPDATE tarefa SET descricao = :descricao WHERE id = :id');

    $stmt->execute(['id' => $id, 'descricao' => $newDescription]);

    echo 'Descrição atualizada com sucesso.';
}

function editarFeito($pdo) {
    echo 'EDITAR FEITO', PHP_EOL;
    $id = readline('ID da tarefa que deseja editar: ');
    $feito = readline('Novo status (0 para não feito, 1 para feito): ');

    // Certifique-se de que $feito seja 0 ou 1
    if ($feito != 0 && $feito != 1) {
        echo 'Status inválido. Use 0 para não feito ou 1 para feito.';
        return;
    }

    $stmt = $pdo->prepare('UPDATE tarefa SET feita = :feito WHERE id = :id');

    $stmt->execute(['id' => $id, 'feito' => $feito]);

    echo 'Status atualizado com sucesso.';
}

$pdo = null;

try {
    $pdo = conectar();

    echo 'Escolha uma opção:', PHP_EOL;
    echo '1. Editar Descrição', PHP_EOL;
    echo '2. Editar Feito', PHP_EOL;

    $opcao = readline('Opção: ');

    if ($opcao == 1) {
        editarDescricao($pdo);
    } elseif ($opcao == 2) {
        editarFeito($pdo);
    } else {
        echo 'Opção inválida.';
    }

} catch (PDOException $e) {
    die('Erro: ' . $e->getMessage());
}
?>
