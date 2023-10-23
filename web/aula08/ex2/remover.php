<?php
$id = isset( $_GET[ 'id' ] ) ? $_GET[ 'id' ] : -1;
if ( ! is_numeric( $id ) ) {
    die( 'Id deve ser um número.' );
}
if ( $id <= 0 ) {
    die( 'Erro: Id não informado ou inválido.' );
}

try {
    $pdo = new PDO( 'mysql:dbname=aula08;host=localhost;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );

    $ps = $pdo->prepare(
        'DELETE FROM contato WHERE id = :id' );
    $ps->execute( [ 'id' => $id ] );

    // echo 'Removido com sucesso. ' .
    //     '<a href="contatos.php" >Ir para a Listagem</a>';

    header( 'Location: contatos.php' );
    die();

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}
?>