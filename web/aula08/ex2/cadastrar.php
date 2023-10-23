<?php
// Pega os dados
$nome = isset( $_POST[ 'nome' ] ) ? $_POST[ 'nome' ] : '';
$telefone = isset( $_POST[ 'telefone' ] ) ? $_POST[ 'telefone' ] : '';
// Valida
$tamanhoNome = mb_strlen( $nome );
if ( $tamanhoNome > 100 || $tamanhoNome < 2 ) {
    die( 'Tamanho de nome incorreto (correto: 2-100).' );
}
$tamanhoTelefone = mb_strlen( $telefone );
if ( $tamanhoTelefone > 10 || $tamanhoTelefone < 9 ) {
    die( 'Tamanho de telefone incorreto (correto: 9-10).' );
}
try {
    $pdo = new PDO( 'mysql:dbname=aula08;host=localhost;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );

    $ps = $pdo->prepare(
        'INSERT INTO contato ( nome, telefone ) VALUES ( :nome, :telefone )' );
    $ps->execute( [ 'nome' => $nome, 'telefone' => $telefone ] );

    echo 'Cadastrado com sucesso. ' .
        '<a href="contatos.php" >Ir para a Listagem</a>';

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}
?>