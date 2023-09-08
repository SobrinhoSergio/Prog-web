<?php
require_once 'Categoria.php';
require_once 'RepositorioCategoria.php';

class RepositorioCategoriaEmBDR
    implements RepositorioCategoria {

    private $pdo = null;

    function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    function categoriaComId( $id ): ?Categoria {
        try {
            $ps = $this->pdo->prepare( 'SELECT * FROM categoria WHERE id = ?' );
            $ps->execute( [ $id ] );
            if ( $ps->rowCount() < 1 ) {
                return null;
            }
            $reg = $ps->fetch( PDO::FETCH_ASSOC );
            return new Categoria( $reg[ 'id' ], $reg[ 'nome' ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao consultar a categoria', 0, $e );
        }
    }

}

