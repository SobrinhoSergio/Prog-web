<?php
require_once 'RepositorioCliente.php';
require_once 'RepositorioClienteEmBDR.php';

const OPCAO_SAIR        = '0';
const OPCAO_LISTAR      = '1';
const OPCAO_CADASTRAR   = '2';
const OPCAO_REMOVER     = '3';

function menu() {
    echo PHP_EOL, 'MENU', PHP_EOL, str_repeat( '-', 40 ), PHP_EOL;
    echo OPCAO_SAIR,      ') Sair', PHP_EOL;
    echo OPCAO_LISTAR,    ') Listar', PHP_EOL;
    echo OPCAO_CADASTRAR, ') Cadastrar', PHP_EOL;
    echo OPCAO_REMOVER,   ') Remover', PHP_EOL;
}

$repositorio = null;
try {
    $pdo = new PDO( 'mysql:dbname=acme1;host=localhost;charset=utf8', 'root', '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );
    $repositorio = new RepositorioClienteEmBDR( $pdo );
} catch ( PDOException $e ) {
    die( 'Erro ao conectar com o banco de dados: ' . $e->getMessage() );
}

do {
    menu();
    $opcao = readline( 'Opção: ' );
    if ( $opcao == OPCAO_LISTAR ) {
        listar( $repositorio );
    } else if ( $opcao == OPCAO_CADASTRAR ) {
        cadastrar( $repositorio );
    } else if ( $opcao == OPCAO_REMOVER ) {
        remover( $repositorio );
    }
} while ( $opcao != OPCAO_SAIR );


function listar( RepositorioCliente $repo ) {
    echo 'LISTAGEM', PHP_EOL, str_repeat( '-', 40 ), PHP_EOL;
    $clientes = [];
    try {
        $clientes = $repo->todos();
    } catch ( Exception $e ) {
        echo $e->getMessage(), PHP_EOL;
    }
    foreach ( $clientes as $c ) {
        echo $c->id, ') ', $c->nome, ' ', primeirosDoisTelefones( $c ), PHP_EOL;
    }
}


function primeirosDoisTelefones( Cliente $c ) {
    $numeros = [];
    $i = 1;
    foreach ( $c->telefones as $tel ) {
        if ( $i > 2 ) { // Máximo 2 telefones
            break;
        }
        $numeros []= $tel->numero;
        $i++;
    }
    return implode( ', ', $numeros );
}


function cadastrar( RepositorioCliente $repo ) {
    echo 'CADASTRO', PHP_EOL, str_repeat( '-', 40 ), PHP_EOL;
    $nome = readline( 'Nome: ' );
    $telefones = [];
    do {
        $num = readline( 'Telefone (deixe vazio para sair): ' );
        if ( ! empty( $num ) ) {
            $telefones []= new Telefone( 0, $num );
        }
    } while ( $num != '' );
    $cliente = new Cliente( 0, $nome, $telefones );
    $problemas = $cliente->validar();
    if ( ! empty( $problemas ) ) {
        echo implode( "\n", $problemas );
        return;
    }
    try {
        $repo->adicionar( $cliente );
    } catch ( Exception $e ) {
        echo $e->getMessage(), PHP_EOL;
    }
}


function remover( RepositorioCliente $repo ) {
    echo 'REMOÇÃO', PHP_EOL, str_repeat( '-', 40 ), PHP_EOL;
    $id = readline( 'Id do cliente: ' );
    try {
        $repo->removerPeloId( $id );
        echo 'Removido.', PHP_EOL;
    } catch ( Exception $e ) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>