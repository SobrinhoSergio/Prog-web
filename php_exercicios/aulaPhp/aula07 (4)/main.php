<?php
require_once 'conta.php';
require_once 'repositorio-exception.php';
require_once 'repositorio-conta.php';
require_once 'repositorio-conta-em-bdr.php';

const OPCAO_SAIR = '0';
const OPCAO_CADASTRAR = '1';
const OPCAO_LISTAR = '2';
const OPCAO_DEPOSITAR = '3';
const OPCAO_TRANSFERIR = '4';

function cadastrar( RepositorioConta $repositorio ) {
    echo 'CADASTRO', PHP_EOL;
    $dono = readline( 'Dono: ' );
    $cpf = readline( 'CPF (só números): ' );
    $senha = readline( 'Senha: ' );
    $saldo = readline( 'Saldo: ' );
    $conta = new Conta( 0, $dono, $cpf, $senha, $saldo );
    $repositorio->cadastrar( $conta ); // RepositorioException
}

function listar( RepositorioConta $repositorio ) {
    $contas = $repositorio->todasAsContas();
    echo 'CONTAS', PHP_EOL;
    foreach ( $contas as $i => $c ) {
        echo $i + 1, ') ', $c->dono, ' CPF: ', $c->cpf, ' Saldo R$ ', $c->saldo, PHP_EOL;
    }
}

function depositar( RepositorioConta $repositorio ) {
    echo 'DEPÓSITO:', PHP_EOL;
    $cpf = readline( 'CPF: ' );
    $senha = readline( 'Senha: ' );
    $valor = readline( 'Valor: ' );
    $ok = $repositorio->depositar( $cpf, $senha, $valor );
    echo $ok ? 'Transferência concluída.' : 'Dados de autenticação incorretos.';
}


function transferir( RepositorioConta $repositorio ) {
    echo 'TRANSFERÊNCIA:', PHP_EOL;
    $cpfO = readline( 'CPF origem: ' );
    $senhaO = readline( 'Senha origem: ' );
    $cpfD = readline( 'CPF destino: ' );
    $senhaD = readline( 'Senha destino: ' );
    $valor = readline( 'Valor: ' );
    $ok = $repositorio->transferir( $cpfO, $senhaO, $cpfD, $senhaD, $valor );
    echo $ok ? 'Transferência concluída.' : 'Dados de autenticação incorretos.';
}


try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=aula07;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
} catch ( PDOException $pe ) {
    die( 'Erro ao conectar com o banco de dados: ' . $pe->getMessage() );
}

$repositorio = new RepositorioContaEmBDR( $pdo );

do {
    echo 'MENU:', PHP_EOL;
    echo '0) SAIR', PHP_EOL;
    echo '1) CADASTRAR', PHP_EOL;
    echo '2) LISTAR', PHP_EOL;
    echo '3) DEPOSITAR', PHP_EOL;
    echo '4) TRANSFERIR', PHP_EOL;
    $opcao = readline( 'Opção: ' );
    try {
        if ( $opcao === OPCAO_CADASTRAR ) {
            cadastrar( $repositorio );
        } else if ( $opcao === OPCAO_LISTAR ) {
            listar( $repositorio );
        } else if ( $opcao === OPCAO_DEPOSITAR ) {
            depositar( $repositorio );
        } else if ( $opcao === OPCAO_TRANSFERIR ) {
            transferir( $repositorio );
        }
    } catch ( RepositorioException $re ) {
        die( $re->getMessage() );
    }
} while ( $opcao != OPCAO_SAIR );

?>
