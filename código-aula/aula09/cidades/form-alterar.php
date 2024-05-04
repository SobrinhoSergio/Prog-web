<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Cidade</title>
</head>
<body>
    <h1>Cidade</h1>

    <?php

    require_once 'RepositorioCidadeEmBdr.php';
    require_once 'conectar.php';
    require_once 'Cidade.php';


    $pdo = null;
    $cidade = new Cidade();

    try{

        $pdo = conectar();

        $repo = new RepositorioCidadeEmBDR( $pdo );
        
        if ( isset( $_GET[ 'id' ] ) ) {
            $cidade = $repo->comId($_GET[ 'id' ] );

            if($cidade === null){
                http_response_code( 404 );
                die("Cidade não encontrada!");
            }
        
        } 
        else {
            http_response_code( 400 );
            die("Parâmetro de URL id não foi fornecido.");
        }

    }catch(PDOException $e){
        http_response_code(500);
        die("Erro processamento Operação!". $e->getMessage());
    }

    ?>

    <form action="alterar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $cidade->id; ?>"/>
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" maxlenght="60"
            value="<?php echo $cidade->nome; ?>"
        />
        <button type="submit">Salvar</button>
    </form>
</body>
</html>

