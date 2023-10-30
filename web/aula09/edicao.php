<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Tarefa</title>
</head>
<body>
    <h1>Alteração</h1>
    
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
    
    <form action="alterar.php" method="POST" >
        
        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>" />
            <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" value="<?php echo $tarefa['descricao']; ?>" />
       
        <input type="checkbox" name="feita" id="feita" value="1"
            <?php echo $tarefa['feita'] ? 'checked' : ''; ?>
        />

        <label for="feita">Feita</label>
        
        <button type="submit" id="salvar">Salvar</button>
    </form>

</body>
</html>