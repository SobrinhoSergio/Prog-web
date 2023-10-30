<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remoção</title>
</head>
<body>
    
<form action="remover.php" method="GET" >
        
        <label for="descricao">Descrição:</label>
       
        <select id="descricao" name="id" >
            
            <?php
                require_once 'conexao.php';

                $pdo = conectar();
                
                $ps = $pdo->prepare( 'SELECT * FROM tarefa' );
                
                $ps->execute();
                
                $tarefas = $ps->fetchAll();
                
                foreach ( $tarefas as $t ) {
                    echo <<<HTML
                    <option value="$t[id]" >$t[descricao]</option>
                    HTML;
                }
            ?>
        </select>
        
        <button type="submit">Enviar</button>
    
    </form>
</body>
</html>