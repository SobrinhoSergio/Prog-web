<?php

class Categoria {

    public $id = 0;
    public $nome = '';

    public function __construct(
        int $id = 0,
        string $nome = ''
    ) {
        $this->id = $id;
        $this->nome = $nome;
    }
}

?>