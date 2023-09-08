<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
    <style>
        tbody tr:nth-child(odd){
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <a href="form.php">Cadastrar</a>
    <h1>Contatos</h1>

    <?php
    $pesquisa = isset( $_GET[ 'p' ] ) ? $_GET[ 'p' ] : '';
    $ordem = isset( $_GET[ 'ordem' ] ) ? $_GET[ 'ordem' ] : 'id';
    $inverter = isset( $_GET[ 'inverter' ] ) && $_GET[ 'inverter' ] == 1;
    ?>
    <form method="GET" action="contatos.php" >
        <label for="pesquisa">Pesquisa:</label>
        <input type="search" name="p" id="pesquisa"
            value="<?php echo $pesquisa; ?>" />
        <label for="ordenacao">Ordenação:</label>
        <select name="ordem" id="ordenacao" >
            <option <?php echo $ordem == 'id' ? 'selected' : ''; ?>
                >id</option>
            <option
                <?php echo $ordem == 'nome' ? 'selected' : ''; ?>
                >nome</option>
            <option
                <?php echo $ordem == 'telefone' ? 'selected' : ''; ?>
                >telefone</option>
        </select>
        <label ><input type="checkbox" name="inverter" value="1"
            <?php echo $inverter ? 'checked' : ''; ?>
            /> Decrescente</label>
        <button type="submit" >Pesquisar</button>
    </form>

    <table> 
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Remoção</th>
                <th>Alteração</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once 'conexao.php';
                $pdo = CriarConexao();

                $inverter = isset( $_GET[ 'inverter' ] ) &&
                $_GET[ 'inverter' ] == 1;

                $sqlOrdem = '';
                if ( isset( $_GET[ 'ordem' ] ) ) {
                    $campo = htmlspecialchars( $_GET[ 'ordem' ] );
                    $permitidos = [ 'id', 'nome', 'telefone' ];
                    $chave = array_search( $campo, $permitidos );
                    if ( $chave === false ) {
                        echo '<p>Campo não permitido.</p>';
                    } else {
                        $sqlOrdem = ' ORDER BY ' . $campo;
                        if ( $inverter ) {
                            $sqlOrdem .= ' DESC';
                        }
                    }
                }

                if(isset($_GET['p'])){
                    $p = htmlspecialchars($_GET['p']);                
                    $ps = $pdo->prepare('Select * FROM contato WHERE id LIKE :id OR nome like :nome OR telefone like :telefone' . $sqlOrdem);
                    $p = '%' . $p . '%';
                    $ps->execute(['id' => $p, 'nome' => $p, 'telefone' => $p]);
                } else {
                    $ps = $pdo->query("Select * FROM contato" . $sqlOrdem);
                }
                foreach($ps as $c){
                    echo <<<html
                        <tr>
                            <td>$c[id]</td>
                            <td>$c[nome]</td>
                            <td>$c[telefone]</td>
                            <td><a href="remover.php?id=$c[id]">Remover</a></td>
                            <td><a href="form.php?id=$c[id]">Alterar</a></td>
                        </tr>
                    html;
                }
            ?>
        </tbody>
    </table>
</body>
</html>