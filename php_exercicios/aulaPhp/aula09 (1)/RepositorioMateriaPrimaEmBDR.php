<?php
require_once 'MateriaPrima.php';
require_once 'RepositorioMateriaPrima.php';

class RepositorioMateriaPrimaEmBDR
    implements RepositorioMateriaPrima {

    private $pdo = null;
    private $repoCategoria = null;

    function __construct( PDO $pdo, RepositorioCategoria $repositorio ) {
        $this->pdo = $pdo;
        $this->repoCategoria = $repositorio;
    }

    function consultarMateriasPrimas(): array {
            try {
            $ps = $this->pdo->query( 'SELECT * FROM materia_prima' );
            $objetos = [];
            foreach ( $ps as $reg ) {
                $categoria = $this->repoCategoria->categoriaComId(
                    $reg[ 'categoria_id' ] );
                $objetos []= new MateriaPrima(
                    $reg[ 'id' ],
                    $reg[ 'descricao' ],
                    $reg[ 'quantidade' ],
                    $reg[ 'custo' ],
                    $categoria
                );
            }
            return $objetos;
        } catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao consultar as matérias-primas', 0, $e );
        }
    }

}
?>