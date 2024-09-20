<?php
require_once 'Conta.php';
require_once 'RepositorioContaEmBDR.php';

$contas = [
    [ "id" => 1, "descricao" => "Energia", "valor" => 200.00 ],
    [ "id" => 2, "descricao" => "Água", "valor" => 60.00 ],
];

function obterContas() {
    global $contas;
    $json = json_encode( $contas );
    header( 'Content-Type: application/json' );
    die( $json );
}

function obterContaPeloId( $url ) {
    global $contas;
    // Quebra a URL para extrair o id
    $pedacosURL = explode( '/', $url );
    $ultimoIndice = count( $pedacosURL ) - 1;
    $id = $pedacosURL[ $ultimoIndice ];
    // Checa o id
    if ( ! is_numeric( $id ) ) {
        http_response_code( 400 ); // Bad Content
        die( 'Por favor, informe um id numérico' );
    }
    // URL correta?
    if ( '/contas-a-pagar/' . $id != $url ) {
        http_response_code( 404 );
        die( 'URL não encontrada.' );
    }
    // Procura a conta pelo id
    $conta = null;
    foreach ( $contas as $c ) {
        if ( $c[ 'id' ] == $id ) {
            $conta = $c;
            break;
        }
    }
    // Não achou ?
    if ( $conta === null ) {
        http_response_code( 404 );
        die( 'Conta não encontrada. 🤷‍♂️' );
    }
    header( 'Content-Type: application/json' );
    die( json_encode( $conta ) );
}


function removerContaPeloId( $url ) {
    global $contas;
    // Quebra a URL para extrair o id
    $pedacosURL = explode( '/', $url );
    $ultimoIndice = count( $pedacosURL ) - 1;
    $id = $pedacosURL[ $ultimoIndice ];
    // Checa o id
    if ( ! is_numeric( $id ) ) {
        http_response_code( 400 ); // Bad Content
        die( 'Por favor, informe um id numérico' );
    }
    // URL correta?
    if ( '/contas-a-pagar/' . $id != $url ) {
        http_response_code( 404 );
        die( 'URL não encontrada.' );
    }
    // Procura a conta pelo id
    $indiceConta = -1;
    foreach ( $contas as $indice => $c ) {
        if ( $c[ 'id' ] == $id ) {
            $indiceConta = $indice;
            break;
        }
    }
    // Não achou ?
    if ( $indiceConta < 0 ) {
        http_response_code( 404 );
        die( 'Conta não encontrada. 🤷‍♂️' );
    }
    // Remove
    unset( $contas[ $indiceConta ] );
    http_response_code( 204 ); // No content
    die();
}

function removerContaPeloIdBD($url) {
    // Quebra a URL para extrair o ID
    $pedacosURL = explode('/', $url);
    $ultimoIndice = count($pedacosURL) - 1;
    $id = $pedacosURL[$ultimoIndice];

    // Checa se o ID é numérico
    if (!is_numeric($id)) {
        http_response_code(400); // Bad Request
        die('Por favor, informe um ID numérico.');
    }

    // URL correta?
    if ('/contas-a-pagar/' . $id != $url) {
        http_response_code(404);
        die('URL não encontrada.');
    }

    try {
        // Conecta ao banco de dados
        $pdo = criarPDO();
        $repositorio = new RepositorioContaEmBDR($pdo);

        // Tenta remover a conta pelo ID
        $contaRemovida = $repositorio->removerContaPeloId($id);

        // Se a conta não foi removida, ela não existe
        if (!$contaRemovida) {
            http_response_code(404); // Not Found
            die('Conta não encontrada. 🤷‍♂️');
        }

        // Sucesso, conta removida
        http_response_code(204); // No Content
    } catch (Exception $e) {
        http_response_code(500); // Internal Server Error
        die('Erro ao acessar o banco de dados: ' . $e->getMessage());
    }
}

function cadastrarConta() {
    $json = file_get_contents( 'php://input' );
    $dados = (array) json_decode( $json );
    $conta = new Conta( 0, $dados[ 'descricao' ], $dados[ 'valor' ] );
    try {
        $pdo = criarPDO();
        $repo = new RepositorioConta( $pdo );
        $repo->adicionar( $conta );
        http_response_code( 201 ); // Created
    } catch ( Exception $e ) {
        http_response_code( 500 ); // Internal Server Error
        die( 'Erro ao realizar o cadastro da conta.' );
    }
}

function listarConta(){
    
    $pdo = null;

    try{

        $pdo = criarPDO();
        
        $repositorio = new RepositorioContaEmBDR($pdo);
        
        $contas = $repositorio->Conta();

        echo <<<HTML
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($contas as $c) {
            echo <<<HTML
                    <tr>
                        <td>{$c->id}</td>
                        <td>{$c->descricao}</td>
                        <td>{$c->valor}</td>
                    </tr>
            HTML;
        }

        echo <<<HTML
                </tbody>
            </table>
        HTML;

    }catch (Exception $e) {
        http_response_code(500);
        die("Erro ao acessar o banco de dados: " . $e->getMessage());
    }

}

function criarPDO(): PDO {
    return new PDO( 'mysql:dbname=aula15;host=localhost;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );
}