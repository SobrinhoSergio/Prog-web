<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Tarefa</title>

    <!-- Adicione os links para os arquivos CSS e JavaScript do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Alteração</h1>

        <?php
        require_once 'conexao.php';

        $id = isset( $_GET['id'] ) ? $_GET['id'] : -1;

        if ( ! is_numeric( $id ) || $id <= 0 ) {
            die( 'Id inválido.' );
        }

        $tarefa = [];

        try {
            $pdo = conectar();

            $ps = $pdo->prepare('SELECT id, descricao, feita FROM tarefa WHERE id = ?' );

            $ps->execute( [ $id ] );

            if ( $ps->rowCount() < 1 ) {
                die( 'Tarefa não encontrada.' );
            }

            $tarefa = $ps->fetch();

        } catch ( PDOException $e ) {
            die( 'Erro ao cadastrar a tarefa.' );
        }
        ?>

    
    <form action="alterar.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>" />
        
        <div class="row  align-items-center">
            <div class="form-group col-8">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" class="form-control" value="<?php echo $tarefa['descricao']; ?>" />
            </div>

            <div class="form-check col">
                <input type="checkbox" name="feita" id="feita" value="1"
                    <?php echo $tarefa['feita'] ? 'checked' : ''; ?>
                    class="form-check-input"
                />
                <label for="feita" class="form-check-label">Feita</label>
            </div>
        
            <div class="col">
                <button type="submit" id="salvar" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</body>
</html>
