<?php
// $_GET, $_POST
// header( 'Content-Type: text/plain' ); // Texto simples

// http_response_code( 404 ); // Not Found (Não Encontado)

// echo 'Recebi <b>',
//     $_POST[ 'nome' ], '</b> - <i>', $_POST[ 'telefone' ], '</i>';

require_once 'conexao.php';
$pdo = criarConexao();

$id = htmlspecialchars( $_POST[ 'id' ] );
$nome = htmlspecialchars( $_POST[ 'nome' ] );
$telefone = htmlspecialchars( $_POST[ 'telefone' ] );
try {
    if ( $id == 0 ) {
        $ps = $pdo->prepare( 'INSERT INTO contato (nome, telefone) VALUES (:nome, :telefone)' );
        $ps->execute( [
            'nome' => $nome,
            'telefone' => $telefone
        ] );
    } else {
        $ps = $pdo->prepare( 'UPDATE contato SET
            nome = :nome, telefone = :telefone WHERE id = :id' );
        $ps->execute( [
            'nome' => $nome,
            'telefone' => $telefone,
            'id' => $id
        ] );
    }

    // Comentado para quando a alteração não altera nada
    // if ( $ps->rowCount() < 1 ) {
    //     http_response_code( 500 );
    //     echo 'Erro ao cadastrar/alterar o contato.
    //         <a href="contatos.php" >Voltar</a>';
    //     die();
    // }

    // Vamos pedir ao browser para redirecionar o usuário para a listagem ;)
    header( 'Location: contatos.php' );
} catch ( PDOException $e ) {
    http_response_code( 500 ); // Server Error
    echo 'Ops... erro ao salvar o contato.';
}
?>