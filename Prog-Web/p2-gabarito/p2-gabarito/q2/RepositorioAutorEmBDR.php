<?php
require_once 'RepositorioAutor.php';

class RepositorioAutorEmBDR implements RepositorioAutor {

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function removerPeloId( $id ): bool {
        $ps = $this->pdo->prepare( 'DELETE FROM autor WHERE id = :id' );
        $ps->execute( [ 'id' => $id ] );
        return $ps->rowCount() > 0;
    }
}
?>