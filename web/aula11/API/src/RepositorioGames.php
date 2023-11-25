<?php

class RepositorioGame{
    private $pdo = null;

    public function __constructor(PDO $pdo){
        $this->pdo = $pdo;
    }

    function obterTodos(){
        $ps = $this->pdo->prepare('SELECT * FROM games');

        $ps->setFetchMode(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Game'
        );

        return $ps->fetchAll();
    }


}