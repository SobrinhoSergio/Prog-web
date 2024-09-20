<?php
require_once 'Game.php';

class RepositorioGame {

    private $pdo = null;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    function obterTodos() {
        $ps = $this->pdo->prepare( 'SELECT * FROM game' );
        // Vai transformar registros em objetos da classe Game
        // ⚠ Campos precisam ser iguais aos atributos da classe
        $ps->setFetchMode(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Game'
        );
        $ps->execute();
        return $ps->fetchAll();
    }

    function adicionar( Game $game ) {
        $ps = $this->pdo->prepare( 'INSERT INTO game
            (  nome,  genero,  ano ) VALUES
            ( :nome, :genero, :ano )' );
        $ps->execute( [
            'nome'   => $game->nome,
            'genero' => $game->genero,
            'ano'    => $game->ano
        ] );
    }
}

?>