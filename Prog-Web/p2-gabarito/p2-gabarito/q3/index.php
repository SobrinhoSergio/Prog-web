<?php
require_once '../conexao.php';
$url = $_SERVER[ 'REQUEST_URI' ];
$metodo = $_SERVER[ 'REQUEST_METHOD' ];

if ( $metodo == 'GET' && mb_strpos( $url, '/frases' ) !== false ) {
    $autor = isset( $_GET[ 'autor' ] ) ? htmlspecialchars( $_GET[ 'autor' ] ) : 0;
    $headers = getallheaders();
    $accept = isset( $headers[ 'Accept' ] ) ? htmlspecialchars( $headers[ 'Accept' ] ) : '';
    $emHTML = $accept === 'text/html'; // bool
    try {
        $frases = consultarFrases( $autor );
        enviarFrases( $autor, $emHTML );
    } catch ( Exception $e ) {
        http_response_code( 500 );
        die( 'Erro ao obter as frases: ' . $e->getMessage() );
    }
} else {
    http_response_code( 404 );
    die( 'Não encontrado.' );
}

function consultarFrases( $autor ) {
    $sql = <<<'SQL'
        SELECT f.id, f.texto, f.nota, a.nome FROM frase f
        INNER JOIN autor a ON a.id = f.autor_id
    SQL;
    $params = [];
    if ( $autor > 0 ) {
        $sql .= ' WHERE f.autor_id = :autor';
        $params[ 'autor' ] = $autor;
    }
    $sql .= ' ORDER BY f.id';
    $pdo = conectar();
    $ps = $pdo->prepare( $sql );
    $ps->execute( $params );
    return $ps->fetchAll( PDO::FETCH_ASSOC );
}

function enviarFrases( $frases, $emHTML ) {
    if ( ! $emHTML ) {
        header( 'Content-Type: application/json' );
        die( json_encode( $frases ) );
    }

    header( 'Content-Type: text/html' );
    echo <<<'HTML'
        <table>
            <thead>
                <tr><th>Id</th><th>Texto</th><th>Nota<th><th>Autor<th></tr>
            </thead>
            <tbody>
    HTML;
    foreach ( $frases as $f ) {
        echo "\n\t\t<tr><td>{$f['id']}<td><td>{$f['texto']}<td><td>{$f['nota']}<td><td>{$f['nome']}<td><tr>";
    }
    echo "\n\t</tbody>\n</table>";
}
?>