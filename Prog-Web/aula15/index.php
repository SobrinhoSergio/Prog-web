<?php
require_once 'contas-a-pagar.php';

$metodo = $_SERVER[ 'REQUEST_METHOD' ];
$url = mb_strtolower( $_SERVER[ 'REQUEST_URI' ] );
// echo 'Método é ', $metodo, ' e URL é ', $url;
// Rodar:
// php -S localhost:8080

if ( $metodo === 'GET' && $url === '/contas-a-pagar' ) {
    obterContas();
} else if ( $metodo === 'GET' && mb_strpos( $url, '/contas-a-pagar' ) !== false ) {
    obterContaPeloId( $url );
} else if ( $metodo === 'DELETE' ) { // TODO: terminar
    die( 'Chegou' );
} else if ( $metodo === 'POST' && $url === '/contas-a-pagar' ) {
    cadastrarConta();
} else {
    http_response_code( 404 );
    die( 'Não achei 🤷‍♂️' );
}
?>


<?php
require_once 'contas-a-pagar.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$url = mb_strtolower($_SERVER['REQUEST_URI']);


if ($metodo === 'GET' && $url === '/contas-a-pagar') {
    obterContas();
} else if ($metodo === 'GET' && mb_strpos($url, '/contas-a-pagar') !== false) {
    obterContaPeloId($url);
} else if ($metodo === 'DELETE' && mb_strpos($url, '/contas-a-pagar') !== false) {
    removerContaPeloId($url);
} else if ($metodo === 'POST' && $url === '/contas-a-pagar') {
    cadastrarConta();
} else {
    http_response_code(404);
    die('Não achei 🤷‍♂️');
}
?>
