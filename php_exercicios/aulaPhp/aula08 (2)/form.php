<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
</head>
<body>
    <?php
    require_once 'conexao.php';
    $c = [
        'id' => 0, // Novo
        'nome' => '',
        'telefone' => ''
    ];
    if ( array_key_exists( 'id', $_GET ) ) {
        $id = htmlspecialchars( $_GET[ 'id' ] );
        try {
            $pdo = criarConexao();
            $ps = $pdo->prepare( 'SELECT * FROM contato WHERE id = ?' );
            $ps->execute( [ $id ] );
            if ( $ps->rowCount() > 0 ) {
                $c = $ps->fetch( PDO::FETCH_ASSOC );
            }
        } catch ( PDOException $e ) {
            echo '<p>Erro ao carregar o contato.</p>';
        }
    }
    ?>
    <form action="cadastrar-alterar.php" method="POST" >
        <input type="hidden" name="id"
            value="<?php echo $c['id']; ?>" />
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome"
            value="<?php echo $c['nome']; ?>" />
        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" id="telefone"
            value="<?php echo $c['telefone']; ?>"/>
        <button type="submit" id="enviar">Enviar</button>
    </form>
</body>
</html>