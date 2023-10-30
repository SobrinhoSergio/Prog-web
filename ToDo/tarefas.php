<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>

    <!-- Adicione os links para os arquivos CSS e JavaScript do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

</head>
<body>
    <div class="container">
        <form method="GET" action="tarefas.php" class="mb-3">
            <div class="row align-items-center">
                <div class="form-group col-10">
                    <label for="pesquisa"><h2>Pesquisa:</h2></label>
                    <input type="search" name="pesquisa" id="pesquisa" class="form-control">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </form>

        <a href="cadastrar.html" class="btn btn-success mb-3">Novo</a>
        
        <h1>Tarefas</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Descrição</th>
                    <th>Feita</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'conexao.php';
                $pdo = conectar();
                gerarLinhas($pdo);
                ?>
            </tbody>
        </table>
    </div>

    <?php

    function gerarLinhas(PDO $pdo) {

        $pesquisa = isset($_GET['pesquisa'])
            ? $_GET['pesquisa'] : '';

        $ps = $pdo->prepare(
            'SELECT id, descricao, feita FROM tarefa
            WHERE id LIKE :id OR descricao LIKE :descricao ');
        $ps->execute([
            'id' => '%' . $pesquisa . '%',
            'descricao' => '%' . $pesquisa . '%'
        ]);
        foreach ($ps as $t) {
            
            $feita = $t['feita'] ? '✅' : '❌';
            
            echo <<<LINHA
            
            <tr>
                <td>$t[id]</td>
                
                <td>$t[descricao]</td>
                
                <td>$feita</td>
                
                <td>
                    <a href="remover.php?id=$t[id]" class="btn btn-danger">
                        <i class="bi bi-archive"></i>
                    </a>
                </td>

                <td>
                    <a href="edicao.php?id=$t[id]" class="btn btn-info">
                        <i class="bi bi-pencil"></i>
                    </a>
                </td>
            </tr>
            LINHA;
        }
    }
    ?>

</body>
</html>
