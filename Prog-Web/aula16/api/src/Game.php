<?php

class Game {
    public $id = 0;
    public $nome = '';
    public $genero = '';
    public $ano = 0;

    public function __construct(
        $id = 0,
        $nome = '',
        $genero = '',
        $ano = 0
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->ano = $ano;
    }
}