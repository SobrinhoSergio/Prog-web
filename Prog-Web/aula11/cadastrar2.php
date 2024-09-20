<?php
require_once 'conta/Conta.php';
require_once 'conta/fabrica-conta.php';
require_once 'log.php';

$id = bin2hex( random_bytes( 5 ) ); // 10 bytes

if ( ! isset(
    $_POST[ 'descricao' ],
    $_POST[ 'tipo' ],
    $_POST[ 'valor' ],
    $_POST[ 'vencimento' ],
    $_POST[ 'paga' ]
) ) {
    die( 'Por favor, informe todos os campos.' );
}


$conta = new Conta(
    htmlspecialchars( $_POST[ 'descricao' ]),
    htmlspecialchars( $_POST[ 'tipo' ] ),
    htmlspecialchars( $_POST[ 'valor' ] ),
    htmlspecialchars( $_POST[ 'vencimento' ] ),
    htmlspecialchars($_POST[ 'paga' ] ),
);

$repositorio = criarRepositorioConta();

if ( $repositorio === null ) {
    die( 'Erro ao cadastrar a conta.' );
}

try {
    $repositorio->adicionar( $conta );
} catch ( Exception $e ) {
    logar( $e );
    die( 'Erro ao cadastrar a conta.' );
}

header( 'Location: listagem-contas.php' );
?>