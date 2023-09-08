<?php
require_once 'conexao.php';
$id = htmlspecialchars( $_GET[ 'id' ] );
try {
    $pdo = criarConexao();
    $ps = $pdo->prepare( 'DELETE FROM contato WHERE id = ?' );
    $ps->execute( [ $id ] );
    // Gera um JavaScript para executar no browser
    echo <<<html
        <script>
            alert( 'Removido com sucesso' );
            location.href="contatos.php"; // Redireciona
        </script>
    html;
} catch ( PDOException $e ) {
    http_response_code( 500 );
    echo 'Erro ao remover o contato.';
}
?>